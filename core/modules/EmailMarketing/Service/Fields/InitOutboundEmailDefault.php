<?php
/**
 * SuiteCRM is a customer relationship management program developed by SuiteCRM Ltd.
 * Copyright (C) 2025 SuiteCRM Ltd.
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUITECRM, SUITECRM DISCLAIMS THE
 * WARRANTY OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more
 * details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License
 * version 3, these Appropriate Legal Notices must retain the display of the
 * "Supercharged by SuiteCRM" logo. If the display of the logos is not reasonably
 * feasible for technical reasons, the Appropriate Legal Notices must display
 * the words "Supercharged by SuiteCRM".
 */

namespace App\Module\EmailMarketing\Service\Fields;

use App\Data\Service\RecordProviderInterface;
use App\Process\Entity\Process;
use App\Process\Service\ProcessHandlerInterface;
use App\UserPreferences\Service\UserPreferencesProviderInterface;
use InvalidArgumentException;

class InitOutboundEmailDefault implements ProcessHandlerInterface
{
    protected const MSG_OPTIONS_NOT_FOUND = 'Process options are not defined';
    public const PROCESS_TYPE = 'outbound-email-default';

    public function __construct(
        protected UserPreferencesProviderInterface $userPreferenceService,
        protected RecordProviderInterface $recordProvider
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function getProcessType(): string
    {
        return self::PROCESS_TYPE;
    }

    public function getHandlerKey(): string
    {
        return self::PROCESS_TYPE;
    }

    /**
     * @inheritDoc
     */
    public function requiredAuthRole(): string
    {
        return 'ROLE_USER';
    }

    /**
     * @inheritDoc
     */
    public function getRequiredACLs(Process $process): array
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function configure(Process $process): void
    {
        $process->setId(self::PROCESS_TYPE);
        $process->setAsync(false);
    }

    /**
     * @inheritDoc
     */
    public function validate(Process $process): void
    {
        $options = $process->getOptions();

        if (empty($options)) {
            throw new InvalidArgumentException(self::MSG_OPTIONS_NOT_FOUND);
        }
    }

    /**
     * @inheritDoc
     * @throws \Exception
     */
    public function run(Process $process): void
    {
        $preferences = $this->userPreferenceService->getUserPreference('Emails')?->getItems() ?? [];
        $id = $preferences['defaultOEAccount'] ?? '';

        $record = null;
        if (!empty($id)) {
            try {
                $record = $this->recordProvider->getRecord('OutboundEmailAccounts', $id);
            } catch (\Throwable $e) {
                $record = null;
            }
            if ($record === null && class_exists(\BeanFactory::class)) {
                try {
                    $bean = \BeanFactory::getBean('OutboundEmailAccounts', $id);
                    if ($bean && !empty($bean->id)) {
                        $record = $this->recordProvider->mapToRecord($bean);
                    }
                } catch (\Throwable $e) {}
            }
        }

        if ($record === null) {
            try {
                if (!class_exists(\OutboundEmail::class) && file_exists(dirname(__DIR__, 4) . '/public/legacy/include/OutboundEmail/OutboundEmail.php')) {
                    require_once dirname(__DIR__, 4) . '/public/legacy/include/OutboundEmail/OutboundEmail.php';
                }
                if (class_exists(\OutboundEmail::class)) {
                    $oe = new \OutboundEmail();
                    $system = $oe->getSystemMailerSettings();
                    if ($system && !empty($system->id)) {
                        try {
                            $record = $this->recordProvider->getRecord('OutboundEmailAccounts', $system->id);
                        } catch (\Throwable $e) {
                            $record = null;
                        }
                        if ($record === null && class_exists(\BeanFactory::class)) {
                            $bean = \BeanFactory::getBean('OutboundEmailAccounts', $system->id);
                            if ($bean && !empty($bean->id)) {
                                $record = $this->recordProvider->mapToRecord($bean);
                            }
                        }
                    }
                }
            } catch (\Throwable $e) {
                $record = null;
            }
        }

        if ($record === null && class_exists(\BeanFactory::class)) {
            try {
                $bean = \BeanFactory::newBean('OutboundEmailAccounts');
                $list = $bean->get_full_list('', "outbound_email.type != 'inbound'");
                if (!empty($list[0])) {
                    $record = $this->recordProvider->mapToRecord($list[0]);
                }
            } catch (\Throwable $e) {}
        }

        if ($record === null) {
            $responseData = [
                'value' => ''
            ];

            $process->setStatus('error');
            $process->setMessages(['LBL_DEFAULT_OUTBOUND_NOT_CONFIGURED']);
            $process->setData($responseData);
            return;
        }

        $attributes = $record->getAttributes() ?? [];

        if (empty($attributes['from_addr'])) {
            $smtpFromName = $attributes['smtp_from_name'] ?? ($attributes['from_name'] ?? '');
            $smtpFromAddr = $attributes['smtp_from_addr'] ?? '';
            if (!empty($smtpFromAddr)) {
                $attributes['from_addr'] = !empty($smtpFromName) ? "$smtpFromName <$smtpFromAddr>" : $smtpFromAddr;
            } else {
                $attributes['from_addr'] = $attributes['name'] ?? '';
            }
        }

        if (empty($attributes['from_name'])) {
            $attributes['from_name'] = $attributes['smtp_from_name'] ?? ($attributes['name'] ?? '');
        }

        if (function_exists('getFormattedFromName')) {
            $formattedName = getFormattedFromName($GLOBALS['current_user'] ?? null, $attributes['from_name'] ?? 'Admisiones Posgrado');
            $attributes['from_name'] = $formattedName;
            $smtpFromAddr = $attributes['smtp_from_addr'] ?? ($attributes['mail_smtpuser'] ?? '');
            if (!empty($smtpFromAddr)) {
                $attributes['from_addr'] = "$formattedName <$smtpFromAddr>";
            }
        }

        if ((empty($attributes['from_addr']) || $attributes['from_addr'] === ' ') && empty($attributes['from_name'])) {
            $responseData = [
                'value' => ''
            ];

            $process->setStatus('error');
            $process->setMessages(['LBL_DEFAULT_OUTBOUND_NOT_CONFIGURED']);
            $process->setData($responseData);
            return;
        }

        $responseData = [
            'value' => $attributes['from_addr'],
            'valueObject' => $attributes,
        ];

        $process->setStatus('success');
        $process->setMessages([]);
        $process->setData($responseData);
    }
}
