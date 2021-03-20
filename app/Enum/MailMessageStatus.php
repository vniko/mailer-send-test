<?php

namespace App\Enum;


class MailMessageStatus extends BaseEnum
{


    public static function posted():MailMessageStatus
    {
        return new class() extends MailMessageStatus {
            public function getIndex(): int
            {
                return 0;
            }

            public function getValue(): string
            {
                return 'posted';
            }

            public function getName(): string
            {
                return 'Posted';
            }

        };
    }

    public static function sent():MailMessageStatus
    {
        return new class() extends MailMessageStatus {
            public function getIndex(): int
            {
                return 1;
            }

            public function getValue(): string
            {
                return 'sent';
            }

            public function getName(): string
            {
                return 'Sent';
            }

        };
    }

    public static function failed():MailMessageStatus
    {
        return new class() extends MailMessageStatus {
            public function getIndex(): int
            {
                return 2;
            }

            public function getValue(): string
            {
                return 'failed';
            }

            public function getName(): string
            {
                return 'Failed';
            }

        };
    }

}
