<?php

namespace Sprint\Migration;

use \Bitrix\Main\Type\DateTime;

class ChangePrice20211228164052 extends Version
{
    protected $description = "Обновление цен на курсы";

    protected $moduleVersion = "4.0.2";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $courses = [
            'PM-001' => ['CODE' => 'PM-001', 'PRICE_RU' => '29 200', 'PRICE_UA' => '8 700'],
            'PM-002' => ['CODE' => 'PM-002', 'PRICE_RU' => '33 200', 'PRICE_UA' => '9 800'],
            'PM-003' => ['CODE' => 'PM-003', 'PRICE_RU' => '33 200', 'PRICE_UA' => '9 800'],
            'PM-004' => ['CODE' => 'PM-004', 'PRICE_RU' => '20 800', 'PRICE_UA' => '6 200'],
            'PM-007' => ['CODE' => 'PM-007', 'PRICE_RU' => '20 800', 'PRICE_UA' => '6 200'],
            'PM-008' => ['CODE' => 'PM-008', 'PRICE_RU' => '20 800', 'PRICE_UA' => '6 200'],
            'PM-032' => ['CODE' => 'PM-032', 'PRICE_RU' => '21 500', 'PRICE_UA' => '6 400'],
            'SDP-004' => ['CODE' => 'SDP-004', 'PRICE_RU' => '28 500', 'PRICE_UA' => '8 400'],
            'SDP-031' => ['CODE' => 'SDP-031', 'PRICE_RU' => '43 500', 'PRICE_UA' => '13 500'],
            'SDP-032' => ['CODE' => 'SDP-032', 'PRICE_RU' => '43 500', 'PRICE_UA' => '13 500'],
            'SDP-033' => ['CODE' => 'SDP-033', 'PRICE_RU' => '64 900', 'PRICE_UA' => '19 200'],
            'SDP-035' => ['CODE' => 'SDP-035', 'PRICE_RU' => '43 500', 'PRICE_UA' => '13 500'],
            'ATL-014' => ['CODE' => 'ATL-014', 'PRICE_RU' => '14 400', 'PRICE_UA' => '4 300'],
            'ATL-016' => ['CODE' => 'ATL-016', 'PRICE_RU' => '14 400', 'PRICE_UA' => '4 300'],
            'ATL-017' => ['CODE' => 'ATL-017', 'PRICE_RU' => '21 800', 'PRICE_UA' => '6 500'],
            'ATL-018' => ['CODE' => 'ATL-018', 'PRICE_RU' => '15 800', 'PRICE_UA' => '4 700'],
            'ATL-019' => ['CODE' => 'ATL-019', 'PRICE_RU' => '14 400', 'PRICE_UA' => '4 300'],
            'ARC-001' => ['CODE' => 'ARC-001', 'PRICE_RU' => '54 900', 'PRICE_UA' => '16 300'],
            'ARC-003' => ['CODE' => 'ARC-003', 'PRICE_RU' => '42 900', 'PRICE_UA' => '12 700'],
            'ARC-004' => ['CODE' => 'ARC-004', 'PRICE_RU' => '42 900', 'PRICE_UA' => '12 700'],
            'ARC-005' => ['CODE' => 'ARC-005', 'PRICE_RU' => '42 900', 'PRICE_UA' => '12 700'],
            'ARC-008' => ['CODE' => 'ARC-008', 'PRICE_RU' => '44 900', 'PRICE_UA' => '13 300'],
            'ARC-013' => ['CODE' => 'ARC-013', 'PRICE_RU' => '44 900', 'PRICE_UA' => '13 300'],
            'ARC-014' => ['CODE' => 'ARC-014', 'PRICE_RU' => '31 500', 'PRICE_UA' => '9 300'],
            'ARC-015' => ['CODE' => 'ARC-015', 'PRICE_RU' => '44 900', 'PRICE_UA' => '13 300'],
            'ARC-016' => ['CODE' => 'ARC-016', 'PRICE_RU' => '42 900', 'PRICE_UA' => '12 700'],
            'BI-001' => ['CODE' => 'BI-001', 'PRICE_RU' => '14 200', 'PRICE_UA' => '4 200'],
            'BI-002' => ['CODE' => 'BI-002', 'PRICE_RU' => '25 000', 'PRICE_UA' => '7 400'],
            'EAS-004' => ['CODE' => 'EAS-004', 'PRICE_RU' => '42 900', 'PRICE_UA' => '12 700'],
            'EAS-011' => ['CODE' => 'EAS-011', 'PRICE_RU' => '27 200', 'PRICE_UA' => '8 100'],
            'EAS-014' => ['CODE' => 'EAS-014', 'PRICE_RU' => '49 900', 'PRICE_UA' => '14 800'],
            'EAS-015' => ['CODE' => 'EAS-015', 'PRICE_RU' => '40 000', 'PRICE_UA' => '11 900'],
            'EAS-017' => ['CODE' => 'EAS-017', 'PRICE_RU' => '40 000', 'PRICE_UA' => '11 900'],
            'EAS-018' => ['CODE' => 'EAS-018', 'PRICE_RU' => '40 000', 'PRICE_UA' => '11 900'],
            'EAS-020' => ['CODE' => 'EAS-020', 'PRICE_RU' => '40 000', 'PRICE_UA' => '11 900'],
            'EAS-022' => ['CODE' => 'EAS-022', 'PRICE_RU' => '26 700', 'PRICE_UA' => '7 900'],
            'EAS-024' => ['CODE' => 'EAS-024', 'PRICE_RU' => '40 000', 'PRICE_UA' => '11 900'],
            'EAS-025' => ['CODE' => 'EAS-025', 'PRICE_RU' => '40 000', 'PRICE_UA' => '11 900'],
            'EAS-026' => ['CODE' => 'EAS-026', 'PRICE_RU' => '40 000', 'PRICE_UA' => '11 900'],
            'EAS-027' => ['CODE' => 'EAS-027', 'PRICE_RU' => '41 900', 'PRICE_UA' => '12 400'],
            'REQ-004' => ['CODE' => 'REQ-004', 'PRICE_RU' => '21 800', 'PRICE_UA' => '6 500'],
            'REQ-005' => ['CODE' => 'REQ-005', 'PRICE_RU' => '10 900', 'PRICE_UA' => '3 200'],
            'REQ-038' => ['CODE' => 'REQ-038', 'PRICE_RU' => '21 800', 'PRICE_UA' => '6 500'],
            'REQ-039' => ['CODE' => 'REQ-039', 'PRICE_RU' => '24 000', 'PRICE_UA' => '7 100'],
            'REQ-045' => ['CODE' => 'REQ-045', 'PRICE_RU' => '23 900', 'PRICE_UA' => '7 100'],
            'REQ-046' => ['CODE' => 'REQ-046', 'PRICE_RU' => '23 900', 'PRICE_UA' => '7 100'],
            'REQ-050' => ['CODE' => 'REQ-050', 'PRICE_RU' => '15 800', 'PRICE_UA' => '4 100'],
            'REQ-051' => ['CODE' => 'REQ-051', 'PRICE_RU' => '15 800', 'PRICE_UA' => '4 100'],
            'REQ-052' => ['CODE' => 'REQ-052', 'PRICE_RU' => '31 500', 'PRICE_UA' => '8 200'],
            'REQ-053' => ['CODE' => 'REQ-053', 'PRICE_RU' => '15 800', 'PRICE_UA' => '4 100'],
            'REQ-054' => ['CODE' => 'REQ-054', 'PRICE_RU' => '31 500', 'PRICE_UA' => '8 200'],
            'REQ-055' => ['CODE' => 'REQ-055', 'PRICE_RU' => '31 500', 'PRICE_UA' => '8 200'],
            'REQ-056' => ['CODE' => 'REQ-056', 'PRICE_RU' => '15 800', 'PRICE_UA' => '4 100'],
            'REQ-057' => ['CODE' => 'REQ-057', 'PRICE_RU' => '15 800', 'PRICE_UA' => '4 100'],
            'REQ-059' => ['CODE' => 'REQ-059', 'PRICE_RU' => '23 900', 'PRICE_UA' => '7 100'],
            'REQ-060' => ['CODE' => 'REQ-060', 'PRICE_RU' => '23 900', 'PRICE_UA' => '7 100'],
            'REQ-061' => ['CODE' => 'REQ-061', 'PRICE_RU' => '23 900', 'PRICE_UA' => '7 100'],
            'REQ-062' => ['CODE' => 'REQ-062', 'PRICE_RU' => '26 000', 'PRICE_UA' => '7 700'],
            'REQ-065' => ['CODE' => 'REQ-065', 'PRICE_RU' => '23 900', 'PRICE_UA' => '7 100'],
            'REQ-066' => ['CODE' => 'REQ-066', 'PRICE_RU' => '28 100', 'PRICE_UA' => '8 300'],
            'REQ-067' => ['CODE' => 'REQ-067', 'PRICE_RU' => '23 900', 'PRICE_UA' => '7 100'],
            'REQ-068' => ['CODE' => 'REQ-068', 'PRICE_RU' => '23 900', 'PRICE_UA' => '7 100'],
            'REQ-069' => ['CODE' => 'REQ-069', 'PRICE_RU' => '23 900', 'PRICE_UA' => '7 100'],
            'REQ-001' => ['CODE' => 'REQ-001', 'PRICE_RU' => '21 800', 'PRICE_UA' => '6 500'],
            'REQ-002' => ['CODE' => 'REQ-002', 'PRICE_RU' => '21 800', 'PRICE_UA' => '6 500'],
            'REQ-003' => ['CODE' => 'REQ-003', 'PRICE_RU' => '27 300', 'PRICE_UA' => '8 100'],
            'REQ-006' => ['CODE' => 'REQ-006', 'PRICE_RU' => '10 900', 'PRICE_UA' => '3 200'],
            'REQ-010' => ['CODE' => 'REQ-010', 'PRICE_RU' => '11 900', 'PRICE_UA' => '3 500'],
            'REQ-023' => ['CODE' => 'REQ-023', 'PRICE_RU' => '27 300', 'PRICE_UA' => '8 100'],
            'REQ-028' => ['CODE' => 'REQ-028', 'PRICE_RU' => '21 800', 'PRICE_UA' => '6 500'],
            'REQ-031' => ['CODE' => 'REQ-031', 'PRICE_RU' => '22 800', 'PRICE_UA' => '6 800'],
            'REQ-037' => ['CODE' => 'REQ-037', 'PRICE_RU' => '27 300', 'PRICE_UA' => '8 100'],
            'REQ-070' => ['CODE' => 'REQ-070', 'PRICE_RU' => '34 900', 'PRICE_UA' => '10 300'],
            'SECR-009' => ['CODE' => 'SECR-009', 'PRICE_RU' => '40 100', 'PRICE_UA' => '11 900'],
            'SECR-010' => ['CODE' => 'SECR-010', 'PRICE_RU' => '33 600', 'PRICE_UA' => '10 000'],
            'DEV-007' => ['CODE' => 'DEV-007', 'PRICE_RU' => '11 800', 'PRICE_UA' => '3 500'],
            'DEV-010' => ['CODE' => 'DEV-010', 'PRICE_RU' => '18 800', 'PRICE_UA' => '5 600'],
            'DEV-017' => ['CODE' => 'DEV-017', 'PRICE_RU' => '10 100', 'PRICE_UA' => '3 000'],
            'DEV-032' => ['CODE' => 'DEV-032', 'PRICE_RU' => '10 100', 'PRICE_UA' => '3 000'],
            'DEV-040' => ['CODE' => 'DEV-040', 'PRICE_RU' => '37 400', 'PRICE_UA' => '11 100'],
            'WEB-002' => ['CODE' => 'WEB-002', 'PRICE_RU' => '9 000', 'PRICE_UA' => '2 700'],
            'WEB-003' => ['CODE' => 'WEB-003', 'PRICE_RU' => '12 000', 'PRICE_UA' => '3 600'],
            'WEB-004' => ['CODE' => 'WEB-004', 'PRICE_RU' => '9 000', 'PRICE_UA' => '2 700'],
            'DEV-001_NET' => ['CODE' => 'DEV-001_NET', 'PRICE_RU' => '29 900', 'PRICE_UA' => '8 900'],
            'DEV-005' => ['CODE' => 'DEV-005', 'PRICE_RU' => '12 000', 'PRICE_UA' => '3 600'],
            'DEV-006_NET' => ['CODE' => 'DEV-006_NET', 'PRICE_RU' => '33 200', 'PRICE_UA' => '9 800'],
            'DEV-009_NET' => ['CODE' => 'DEV-009_NET', 'PRICE_RU' => '18 800', 'PRICE_UA' => '5 600'],
            'NET-001' => ['CODE' => 'NET-001', 'PRICE_RU' => '45 800', 'PRICE_UA' => '13 600'],
            'NET-003' => ['CODE' => 'NET-003', 'PRICE_RU' => '13 100', 'PRICE_UA' => '3 900'],
            'NET-006' => ['CODE' => 'NET-006', 'PRICE_RU' => '20 000', 'PRICE_UA' => '5 900'],
            'NET-010' => ['CODE' => 'NET-010', 'PRICE_RU' => '8 400', 'PRICE_UA' => '2 500'],
            'NET-011' => ['CODE' => 'NET-011', 'PRICE_RU' => '11 400', 'PRICE_UA' => '3 400'],
            'SDP-030_PRG' => ['CODE' => 'SDP-030_PRG', 'PRICE_RU' => '33 200', 'PRICE_UA' => '9 800'],
            'JVA-007' => ['CODE' => 'JVA-007', 'PRICE_RU' => '40 000', 'PRICE_UA' => '11 900'],
            'JVA-008' => ['CODE' => 'JVA-008', 'PRICE_RU' => '40 000', 'PRICE_UA' => '11 900'],
            'JVA-060' => ['CODE' => 'JVA-060', 'PRICE_RU' => '9 200', 'PRICE_UA' => '2 700'],
            'JVA-035' => ['CODE' => 'JVA-035', 'PRICE_RU' => '8 400', 'PRICE_UA' => '2 500'],
            'DEV-001_JVA' => ['CODE' => 'DEV-001_JVA', 'PRICE_RU' => '27 500', 'PRICE_UA' => '8 100'],
            'DEV-006_JVA' => ['CODE' => 'DEV-006_JVA', 'PRICE_RU' => '27 500', 'PRICE_UA' => '8 100'],
            'JVA-017' => ['CODE' => 'JVA-017', 'PRICE_RU' => '34 700', 'PRICE_UA' => '10 300'],
            'JVA-067' => ['CODE' => 'JVA-067', 'PRICE_RU' => '15 300', 'PRICE_UA' => '4 500'],
            'JVA-016' => ['CODE' => 'JVA-016', 'PRICE_RU' => '8 400', 'PRICE_UA' => '2 500'],
            'JVA-074' => ['CODE' => 'JVA-074', 'PRICE_RU' => '59 900', 'PRICE_UA' => '17 700'],
            'JVA-076' => ['CODE' => 'JVA-076', 'PRICE_RU' => '65 400', 'PRICE_UA' => '19 400'],
            'JVA-001' => ['CODE' => 'JVA-001', 'PRICE_RU' => '22 200', 'PRICE_UA' => '6 600'],
            'JVA-037' => ['CODE' => 'JVA-037', 'PRICE_RU' => '22 200', 'PRICE_UA' => '6 600'],
            'JVA-059' => ['CODE' => 'JVA-059', 'PRICE_RU' => '16 600', 'PRICE_UA' => '4 900'],
            'JVA-009' => ['CODE' => 'JVA-009', 'PRICE_RU' => '40 000', 'PRICE_UA' => '11 900'],
            'JVA-002' => ['CODE' => 'JVA-002', 'PRICE_RU' => '27 500', 'PRICE_UA' => '8 100'],
            'JVA-014' => ['CODE' => 'JVA-014', 'PRICE_RU' => '30 500', 'PRICE_UA' => '9 000'],
            'JVA-031' => ['CODE' => 'JVA-031', 'PRICE_RU' => '43 500', 'PRICE_UA' => '12 900'],
            'JVA-010' => ['CODE' => 'JVA-010', 'PRICE_RU' => '43 500', 'PRICE_UA' => '12 900'],
            'JVA-013' => ['CODE' => 'JVA-013', 'PRICE_RU' => '25 100', 'PRICE_UA' => '7 400'],
            'JVA-043' => ['CODE' => 'JVA-043', 'PRICE_RU' => '34 700', 'PRICE_UA' => '10 300'],
            'JVA-075' => ['CODE' => 'JVA-075', 'PRICE_RU' => '65 400', 'PRICE_UA' => '19 400'],
            'JVA-077' => ['CODE' => 'JVA-077', 'PRICE_RU' => '44 100', 'PRICE_UA' => '13 100'],
            'JVA-078' => ['CODE' => 'JVA-078', 'PRICE_RU' => '52 900', 'PRICE_UA' => '15 700'],
            'WEB-007' => ['CODE' => 'WEB-007', 'PRICE_RU' => '38 300', 'PRICE_UA' => '11 300'],
            'WEB-012' => ['CODE' => 'WEB-012', 'PRICE_RU' => '34 700', 'PRICE_UA' => '10 300'],
            'WEB-015' => ['CODE' => 'WEB-015', 'PRICE_RU' => '12 200', 'PRICE_UA' => '3 600'],
            'WEB-017' => ['CODE' => 'WEB-017', 'PRICE_RU' => '12 200', 'PRICE_UA' => '3 600'],
            'WEB-021' => ['CODE' => 'WEB-021', 'PRICE_RU' => '34 700', 'PRICE_UA' => '10 300'],
            'WEB-022' => ['CODE' => 'WEB-022', 'PRICE_RU' => '40 100', 'PRICE_UA' => '11 900'],
            'WEB-023' => ['CODE' => 'WEB-023', 'PRICE_RU' => '43 900', 'PRICE_UA' => '13 000'],
            'C-003' => ['CODE' => 'C-003', 'PRICE_RU' => '39 300', 'PRICE_UA' => '11 600'],
            'C-005' => ['CODE' => 'C-005', 'PRICE_RU' => '27 500', 'PRICE_UA' => '8 100'],
            'C-006' => ['CODE' => 'C-006', 'PRICE_RU' => '20 400', 'PRICE_UA' => '6 000'],
            'C-007' => ['CODE' => 'C-007', 'PRICE_RU' => '35 500', 'PRICE_UA' => '10 500'],
            'DEV-001_C++' => ['CODE' => 'DEV-001_C++', 'PRICE_RU' => '27 500', 'PRICE_UA' => '8 100'],
            'DEV-006_C++' => ['CODE' => 'DEV-006_C++', 'PRICE_RU' => '27 500', 'PRICE_UA' => '8 100'],
            'DEV-009_C++' => ['CODE' => 'DEV-009_C++', 'PRICE_RU' => '18 800', 'PRICE_UA' => '5 600'],
            'DB-013' => ['CODE' => 'DB-013', 'PRICE_RU' => '7 200', 'PRICE_UA' => '2 100'],
            'DB-021' => ['CODE' => 'DB-021', 'PRICE_RU' => '39 900', 'PRICE_UA' => '11 800'],
            'DB-025' => ['CODE' => 'DB-025', 'PRICE_RU' => '14 500', 'PRICE_UA' => '4 300'],
            'DB-026' => ['CODE' => 'DB-026', 'PRICE_RU' => '19 900', 'PRICE_UA' => '5 900'],
            'DB-027' => ['CODE' => 'DB-027', 'PRICE_RU' => '14 500', 'PRICE_UA' => '4 300'],
            'DB-028' => ['CODE' => 'DB-028', 'PRICE_RU' => '29 900', 'PRICE_UA' => '8 900'],
            'DB-029' => ['CODE' => 'DB-029', 'PRICE_RU' => '19 900', 'PRICE_UA' => '5 900'],
            'SCRIPT-002' => ['CODE' => 'SCRIPT-002', 'PRICE_RU' => '22 900', 'PRICE_UA' => '6 800'],
            'SCRIPT-003' => ['CODE' => 'SCRIPT-003', 'PRICE_RU' => '25 900', 'PRICE_UA' => '7 700'],
            'SCRIPT-007' => ['CODE' => 'SCRIPT-007', 'PRICE_RU' => '31 000', 'PRICE_UA' => '9 200'],
            'SQA-002' => ['CODE' => 'SQA-002', 'PRICE_RU' => '15 600', 'PRICE_UA' => '4 600'],
            'SQA-003' => ['CODE' => 'SQA-003', 'PRICE_RU' => '9 200', 'PRICE_UA' => '2 700'],
            'SQA-004' => ['CODE' => 'SQA-004', 'PRICE_RU' => '5 900', 'PRICE_UA' => '1 700'],
            'SQA-005' => ['CODE' => 'SQA-005', 'PRICE_RU' => '6 800', 'PRICE_UA' => '2 000'],
            'SQA-024' => ['CODE' => 'SQA-024', 'PRICE_RU' => '9 200', 'PRICE_UA' => '2 700'],
            'SQA-026' => ['CODE' => 'SQA-026', 'PRICE_RU' => '15 600', 'PRICE_UA' => '4 600'],
            'SQA-028' => ['CODE' => 'SQA-028', 'PRICE_RU' => '15 600', 'PRICE_UA' => '4 600'],
            'SQA-029' => ['CODE' => 'SQA-029', 'PRICE_RU' => '15 600', 'PRICE_UA' => '4 600'],
            'SQA-030' => ['CODE' => 'SQA-030', 'PRICE_RU' => '10 600', 'PRICE_UA' => '3 100'],
            'SQA-036' => ['CODE' => 'SQA-036', 'PRICE_RU' => '9 200', 'PRICE_UA' => '2 700'],
            'SQA-043' => ['CODE' => 'SQA-043', 'PRICE_RU' => '24 000', 'PRICE_UA' => '7 100'],
            'SQA-033' => ['CODE' => 'SQA-033', 'PRICE_RU' => '6 200', 'PRICE_UA' => '1 800'],
            'SQA-044' => ['CODE' => 'SQA-044', 'PRICE_RU' => '10 100', 'PRICE_UA' => '3 000'],
            'SQA-049' => ['CODE' => 'SQA-049', 'PRICE_RU' => '32 900', 'PRICE_UA' => '9 700'],
            'SQA-050' => ['CODE' => 'SQA-050', 'PRICE_RU' => '21 900', 'PRICE_UA' => '6 500'],
            'SQA-051' => ['CODE' => 'SQA-051', 'PRICE_RU' => '20 600', 'PRICE_UA' => '6 100'],
            'SS-001' => ['CODE' => 'SS-001', 'PRICE_RU' => '25 000', 'PRICE_UA' => '7 400'],
            'SS-004' => ['CODE' => 'SS-004', 'PRICE_RU' => '20 800', 'PRICE_UA' => '6 200'],
            'SS-005' => ['CODE' => 'SS-005', 'PRICE_RU' => '25 000', 'PRICE_UA' => '7 400'],
            'SS-006' => ['CODE' => 'SS-006', 'PRICE_RU' => '15 000', 'PRICE_UA' => '4 400'],
            'SS-011' => ['CODE' => 'SS-011', 'PRICE_RU' => '15 000', 'PRICE_UA' => '4 400'],
            'OFFICE-004' => ['CODE' => 'OFFICE-004', 'PRICE_RU' => '11 500', 'PRICE_UA' => '3 400'],
            'SS-002_RUS' => ['CODE' => 'SS-002_RUS', 'PRICE_RU' => '16 500', 'PRICE_UA' => '4 900'],
            'SS-007' => ['CODE' => 'SS-007', 'PRICE_RU' => '15 000', 'PRICE_UA' => '4 400'],
            'SS-008' => ['CODE' => 'SS-008', 'PRICE_RU' => '15 000', 'PRICE_UA' => '4 400'],
            'SS-097' => ['CODE' => 'SS-097', 'PRICE_RU' => '16 500', 'PRICE_UA' => '4 900'],
            'SS-105' => ['CODE' => 'SS-105', 'PRICE_RU' => '16 500', 'PRICE_UA' => '4 900'],
            'SS-106' => ['CODE' => 'SS-106', 'PRICE_RU' => '16 500', 'PRICE_UA' => '4 900'],
            'ADM-007' => ['CODE' => 'ADM-007', 'PRICE_RU' => '12 400', 'PRICE_UA' => '3 700'],
            'ADM-019' => ['CODE' => 'ADM-019', 'PRICE_RU' => '21 900', 'PRICE_UA' => '6 500'],
            'ADM-021' => ['CODE' => 'ADM-021', 'PRICE_RU' => '38 500', 'PRICE_UA' => '11 400'],
            'ADM-022' => ['CODE' => 'ADM-022', 'PRICE_RU' => '32 900', 'PRICE_UA' => '9 700'],
            'ADM-025' => ['CODE' => 'ADM-025', 'PRICE_RU' => '21 900', 'PRICE_UA' => '6 500'],
            'BAN-001' => ['CODE' => 'BAN-001', 'PRICE_RU' => '13 800', 'PRICE_UA' => '4 100'],
            'FIN-001' => ['CODE' => 'FIN-001', 'PRICE_RU' => '9 200', 'PRICE_UA' => '2 700'],
            'FIN-072' => ['CODE' => 'FIN-072', 'PRICE_RU' => '9 200', 'PRICE_UA' => '2 700'],
            'FIN-074' => ['CODE' => 'FIN-074', 'PRICE_RU' => '3 000', 'PRICE_UA' => '900'],
        ];

        foreach ($courses as &$course) {
            $course['PRICE_RU'] = floatval(str_replace(' ', '', $course['PRICE_RU']));
            $course['PRICE_UA'] =  floatval(str_replace(' ', '', $course['PRICE_UA']));
            unset($course);
        }

        $Iblock = $this->getHelperManager()->Iblock();
        $coursesIblockId = $Iblock->getIblockId('courses','edu');

        $coursesCollection = \Bitrix\Iblock\Elements\ElementCoursesTable::getList([
            'select' => ['ID','CODE','TIMESTAMP_X','course_code','course_price','COURSE_PRICE_UA'],
            'filter' => ['course_code.VALUE' => array_keys($courses)],
        ])->fetchCollection();
        $courseCounts = 0;
        foreach ($coursesCollection as $itemCollection) {
            $courseCode = $itemCollection->get('course_code')->getValue();
            if(!$course = $courses[$courseCode]) {
                echo "Не найден курс {$courseCode}<br>";
                unset($course);
                continue;
            }
            $itemCollection->get('course_price')->setValue($course['PRICE_RU']);
            $itemCollection->get('COURSE_PRICE_UA')->setValue($course['PRICE_UA']);

            $itemCollection->set('TIMESTAMP_X', (new DateTime())->format('d.m.Y H:i:s'));
            $itemCollection->save();
            $courseCounts++;
            unset($course);
        }
        $coursesCollection->save();

        $allCourseCount = count($courses);
        echo "Изменена цена у {$courseCounts} из {$allCourseCount}<br>";

        $scheduleCourses = [];

        $scheduleCollection = \Bitrix\Iblock\Elements\ElementScheduleTable::getList([
            'select' => ['ID','CODE','TIMESTAMP_X','course_code','schedule_price','schedule_onl_price'],
            'filter' => ['course_code.VALUE' => array_keys($courses)],
        ])->fetchCollection();

        foreach ($scheduleCollection as $scheduleItem) {
            $courseCode = $scheduleItem->get('course_code')->getValue();
            if($course = $courses[$courseCode]) {
                $scheduleCourses[$scheduleItem->getId()] = $courseCode;
                $scheduleItem->get('schedule_price')->setValue($course['PRICE_RU']);
                $scheduleItem->get('schedule_onl_price')->setValue($course['PRICE_UA']);

                $scheduleItem->set('TIMESTAMP_X', (new DateTime())->format('d.m.Y H:i:s'));
                $scheduleItem->save();
                unset($course);
            };
        }
        $scheduleCollection->save();


        $catalogCollection = \Bitrix\Catalog\PriceTable::getList([
            'filter' => ['PRODUCT_ID' => array_keys($scheduleCourses)],
            'select' => ['*']
        ])->fetchCollection();


        foreach ($catalogCollection as $catalogItem) {
            $productId = $catalogItem->get('PRODUCT_ID');
            if($productId) {
                if($courseCode = $scheduleCourses[$productId]) {
                    $course = $courses[$courseCode];
                    if($catalogItem->get('CATALOG_GROUP_ID') == '1') {
                        $catalogItem->set('PRICE', $course['PRICE_RU']);
                    }
                    if($catalogItem->get('CATALOG_GROUP_ID') == '3') {
                        $catalogItem->set('PRICE', $course['PRICE_UA']);
                    }
                    $catalogItem->save();
                }
            }
        }
        $catalogCollection->save();
    }

    public function down()
    {

    }
}

