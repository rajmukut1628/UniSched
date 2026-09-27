<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>{{ $title }} | UniSched</title>

    <style>

        @page {
            size: A4 landscape;
            margin: 10mm;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;

            padding: 20px;

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            color: #111827;

            background: #eef2f7;
        }

        .toolbar {
            max-width: 1500px;

            margin:
                0 auto
                15px;

            display: flex;

            align-items: center;
            justify-content: space-between;

            gap: 10px;

            padding: 12px 14px;

            border-radius: 10px;

            background: #111827;

            color: white;
        }

        .toolbar-left {
            font-size: 13px;
            font-weight: 700;
        }

        .toolbar-actions {
            display: flex;
            gap: 8px;
        }

        .btn {
            padding: 9px 13px;

            border: 0;

            border-radius: 7px;

            cursor: pointer;

            font-size: 11px;
            font-weight: 700;

            text-decoration: none;
        }

        .print-btn {
            color: white;
            background: #2563eb;
        }

        .back-btn {
            color: #e5e7eb;
            background: #374151;
        }

        .sheet {
            max-width: 1500px;

            margin: auto;

            padding: 20px;

            background: white;

            box-shadow:
                0 10px 40px
                rgba(0,0,0,.08);
        }

        .header {
            position: relative;

            padding-bottom: 13px;

            margin-bottom: 14px;

            text-align: center;

            border-bottom: 2px solid #111827;
        }

        .system-name {
            margin-bottom: 5px;

            font-size: 11px;
            font-weight: 700;

            letter-spacing: 2px;

            text-transform: uppercase;
        }

        .university {
            margin: 0;

            font-size: 22px;
            font-weight: 800;
        }

        .department {
            margin-top: 4px;

            font-size: 13px;
            font-weight: 700;
        }

        .routine-title {
            margin-top: 11px;

            font-size: 17px;
            font-weight: 800;
        }

        .subtitle {
            margin-top: 5px;

            color: #4b5563;

            font-size: 10px;
        }

        .meta {
            display: flex;

            justify-content: space-between;

            gap: 15px;

            margin-bottom: 12px;

            font-size: 9px;

            color: #4b5563;
        }

        .meta strong {
            color: #111827;
        }

        .table-wrapper {
            width: 100%;
            overflow: hidden;
        }

        table {
            width: 100%;

            border-collapse: collapse;

            table-layout: fixed;
        }

        th,
        td {
            border: 1px solid #9ca3af;
        }

        th {
            padding: 7px 4px;

            background: #e5e7eb;

            font-size: 8px;
            font-weight: 800;

            text-align: center;
        }

        th.day {
            width: 70px;
        }

        td {
            min-height: 65px;

            padding: 4px;

            vertical-align: top;
        }

        .day-cell {
            background: #f3f4f6;

            text-align: center;
            vertical-align: middle;

            font-size: 9px;
            font-weight: 800;
        }

        .class-card {
            padding: 5px;

            margin-bottom: 4px;

            border:
                1px solid #d1d5db;

            border-radius: 4px;

            page-break-inside: avoid;
        }

        .class-card:last-child {
            margin-bottom: 0;
        }

        .course-code {
            font-size: 8px;
            font-weight: 900;
        }

        .course-name {
            margin-top: 2px;

            font-size: 6.5px;

            line-height: 1.25;
        }

        .details {
            margin-top: 4px;

            display: grid;

            grid-template-columns:
                1fr 1fr;

            gap: 2px;

            font-size: 6.5px;
        }

        .detail {
            padding: 2px 3px;

            border-radius: 2px;

            background: #f3f4f6;
        }

        .empty {
            height: 60px;

            text-align: center;
            vertical-align: middle;

            color: #9ca3af;

            font-size: 9px;
        }

        .footer {
            display: flex;

            justify-content: space-between;

            gap: 30px;

            margin-top: 30px;

            padding-top: 15px;
        }

        .signature {
            width: 180px;

            padding-top: 7px;

            border-top:
                1px solid #111827;

            text-align: center;

            font-size: 8px;
        }

        .no-data {
            padding: 60px 20px;

            text-align: center;

            border:
                1px solid #d1d5db;

            font-size: 14px;
        }

        @media print {

            body {
                padding: 0;

                background: white;

                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .toolbar {
                display: none !important;
            }

            .sheet {
                max-width: none;

                padding: 0;

                box-shadow: none;
            }

            .header {
                margin-top: 0;
            }

            thead {
                display: table-header-group;
            }

            tr {
                page-break-inside: avoid;
            }
        }

    </style>

</head>

<body>


<div class="toolbar">

    <div class="toolbar-left">
        UniSched Professional Routine Export
    </div>

    <div class="toolbar-actions">

        <a
            href="{{ route('admin.routine-views.index') }}"
            class="btn back-btn"
        >
            Back to Routine
        </a>

        <button
            type="button"
            class="btn print-btn"
            onclick="window.print()"
        >
            Print / Save PDF
        </button>

    </div>

</div>


<div class="sheet">

    <div class="header">

        <div class="system-name">
            UniSched
        </div>

        <h1 class="university">
            University Academic Routine
        </h1>

        <div class="department">
            Department of Computer Science & Engineering
        </div>

        <div class="routine-title">
            {{ $title }}
        </div>

        <div class="subtitle">
            {{ $subtitle }}
        </div>

    </div>


    <div class="meta">

        <div>

            <strong>Status:</strong>
            Published Routine Only

        </div>

        <div>

            <strong>Total Classes:</strong>
            {{ $routines->count() }}

        </div>

        <div>

            <strong>Generated:</strong>
            {{ now()->format('d M Y, h:i A') }}

        </div>

    </div>


    @if($routines->count())

        <div class="table-wrapper">

            <table>

                <thead>

                <tr>

                    <th class="day">
                        DAY
                    </th>

                    @foreach($timeSlots as $slot)

                        <th>

                            {{ \Carbon\Carbon::parse(
                                $slot->start_time
                            )->format('g:i A') }}

                            <br>

                            -

                            <br>

                            {{ \Carbon\Carbon::parse(
                                $slot->end_time
                            )->format('g:i A') }}

                        </th>

                    @endforeach

                </tr>

                </thead>


                <tbody>

                @foreach($days as $day)

                    <tr>

                        <td class="day-cell">
                            {{ $day }}
                        </td>


                        @foreach($timeSlots as $slot)

                            <td>

                                @php

                                    $classes =
                                        $routineMap[$day][$slot->id]
                                        ?? [];

                                @endphp


                                @forelse($classes as $routine)

                                    <div class="class-card">

                                        <div class="course-code">

                                            {{ $routine->courseAssignment->course->course_code }}

                                        </div>


                                        <div class="course-name">

                                            {{ $routine->courseAssignment->course->course_name }}

                                        </div>


                                        <div class="details">

                                            <div class="detail">

                                                Sem:
                                                {{ $routine->section->semester->number }}

                                            </div>

                                            <div class="detail">

                                                Sec:
                                                {{ $routine->section->code }}

                                            </div>

                                            <div class="detail">

                                                Faculty:
                                                {{ $routine->teacher->initial }}

                                            </div>

                                            <div class="detail">

                                                Room:
                                                {{ $routine->room->room_number }}

                                            </div>

                                        </div>

                                    </div>

                                @empty

                                    <div class="empty">
                                        —
                                    </div>

                                @endforelse

                            </td>

                        @endforeach

                    </tr>

                @endforeach

                </tbody>

            </table>

        </div>


        <div class="footer">

            <div class="signature">
                Prepared By
            </div>

            <div class="signature">
                Routine Coordinator
            </div>

            <div class="signature">
                Head of Department
            </div>

        </div>

    @else

        <div class="no-data">

            No published routine classes were found for this selection.

        </div>

    @endif

</div>


</body>

</html>