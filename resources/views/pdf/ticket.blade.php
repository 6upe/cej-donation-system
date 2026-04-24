<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>EPD2026 Receipt</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: Calibri, Arial, sans-serif;
            font-size: 11px;
            color: #111;
            background: #ffffff;
            padding: 20px;
        }

        @media print {
            body { background: #fff; padding: 0; }
            .wrap { box-shadow: none; border: none; }
        }

        .wrap {
            width: 740px;
            margin: 0 auto;
            background: #fff;
            box-shadow: 0 2px 12px rgba(0,0,0,0.18);
        }

        /* BANNER */
        .banner {
            width: 740px;
            height: 200px;
            overflow: hidden;
            background: #ffffff;
        }
        .banner img {
            width: 740px;
            height: 200px;
            object-fit: cover;
            object-position: center center;
            display: block;
        }

        /* HEADER INFO */
        .header {
            border-bottom: 1.5px solid #008000;
            padding: 8px 18px;
            display: table;
            width: 100%;
            table-layout: fixed;
        }
        .header-left {
            display: table-cell;
            vertical-align: middle;
        }
        .header-right {
            display: table-cell;
            vertical-align: middle;
            text-align: right;
            width: 260px;
        }
        .event-name {
            font-size: 13px;
            font-weight: bold;
            color: #111;
        }
        .event-sub {
            font-size: 8px;
            color: #888;
            margin-top: 2px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .org-info {
            font-size: 8px;
            color: #888;
            line-height: 1.6;
            text-align: right;
        }

        /* STATUS BAR */
        .statusbar {
            background: #008000;
            padding: 5px 18px;
            display: table;
            width: 100%;
            table-layout: fixed;
        }
        .statusbar-left {
            display: table-cell;
            vertical-align: middle;
        }
        .statusbar-right {
            display: table-cell;
            vertical-align: middle;
            text-align: right;
            width: 200px;
        }
        .ticket-code-label {
            font-size: 7px;
            color: #777;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }
        .ticket-code {
            font-family: 'Courier New', monospace;
            font-size: 14px;
            color: #fff;
            font-weight: bold;
            letter-spacing: 1.5px;
        }
        .status-pills { display: inline-flex; gap: 5px; }
        .pill {
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            /* border: 1px solid #555; */
            color: #ffffff;
            padding: 2px 7px;
        }

        /* MAIN BODY */
        .body {
            display: table;
            width: 100%;
            table-layout: fixed;
            border-bottom: 1px solid #e0e0e0;
        }

        /* LEFT: ticket + participant */
        .col-left {
            display: table-cell;
            vertical-align: top;
            padding: 12px 18px;
            border-right: 1px solid #e0e0e0;
        }

        /* RIGHT: payment + QR */
        .col-right {
            display: table-cell;
            vertical-align: top;
            padding: 12px 18px;
            width: 310px;
        }

        /* section title */
        .sec {
            font-size: 7.5px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #aaa;
            border-bottom: 1px solid #e8e8e8;
            padding-bottom: 3px;
            margin-bottom: 8px;
            margin-top: 10px;
            display: block;
        }
        .sec:first-child { margin-top: 0; }

        /* field grid */
        .g2 { display: table; width: 100%; table-layout: fixed; margin-bottom: 0; }
        .g2-row { display: table-row; }
        .g2-cell { display: table-cell; vertical-align: top; padding-bottom: 5px; padding-right: 8px; width: 50%; }
        .g2-cell:last-child { padding-right: 0; }

        .lbl { font-size: 7.5px; color: #aaa; text-transform: uppercase; letter-spacing: 0.3px; margin-bottom: 1px; }
        .val { font-size: 11px; font-weight: bold; color: #111; line-height: 1.2; }
        .val-name { font-size: 13px; font-weight: bold; color: #111; }
        .val-mono { font-family: 'Courier New', monospace; font-size: 10px; font-weight: bold; color: #111; }

        /* amount */
        .amount-block {
            margin-top: 8px;
            padding-top: 8px;
            border-top: 1.5px solid #008000;
            display: table;
            width: 100%;
        }
        .amount-label-cell { display: table-cell; vertical-align: middle; }
        .amount-val-cell { display: table-cell; vertical-align: middle; text-align: right; }
        .amount-lbl { font-size: 7.5px; text-transform: uppercase; letter-spacing: 0.4px; color: #aaa; }
        .amount-val { font-size: 22px; font-weight: bold; color: #111; }
        .amount-cur { font-size: 10px; font-weight: bold; color: #888; margin-right: 2px; }

        /* QR */
        .qr-wrap { text-align: center; margin-top: 12px; }
        .qr-frame { display: inline-block; border: 1px solid #ccc; padding: 5px; background: #fff; }
        .qr-frame img { width: 100px; height: 100px; display: block; }
        .qr-lbl { font-size: 7.5px; color: #aaa; text-transform: uppercase; letter-spacing: 0.4px; margin-top: 4px; }

        /* PERFORATION */
        .perf {
            position: relative;
            height: 1px;
            background: repeating-linear-gradient(90deg, #ffffff 0, #bbb 5px, transparent 5px, transparent 10px);
        }
        .perf::before, .perf::after {
            content: '';
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 12px; height: 12px;
            background: #ffffff;
            border-radius: 50%;
        }
        .perf::before { left: -6px; }
        .perf::after  { right: -6px; }

        /* STUB */
        .stub {
            background: #008000;
            padding: 7px 18px;
            display: table;
            width: 100%;
            table-layout: fixed;
        }
        .stub-cell {
            display: table-cell;
            vertical-align: middle;
            padding-right: 12px;
        }
        .stub-cell-qr {
            display: table-cell;
            vertical-align: middle;
            text-align: right;
            width: 48px;
        }
        .stub-lbl { font-size: 7px; color: #555; text-transform: uppercase; letter-spacing: 0.6px; margin-bottom: 1px; }
        .stub-val { font-size: 10px; color: #fff; font-weight: bold; }
        .stub-code { font-family: 'Courier New', monospace; font-size: 12px; color: #fff; font-weight: bold; letter-spacing: 1.5px; }
        .stub-qr { border: 1px solid #333; padding: 2px; background: #fff; display: inline-block; }
        .stub-qr img { width: 36px; height: 36px; display: block; }

        /* DIVIDERS between stub cells */
        .stub-div {
            display: table-cell;
            vertical-align: middle;
            width: 1px;
            padding-right: 12px;
        }
        /* .stub-div-line { width: 1px; height: 20px; background: #333; } */

        /* FOOTER */
        .footer {
            padding: 5px 18px;
            display: table;
            width: 100%;
            table-layout: fixed;
            background: #f8f8f8;
            border-top: 1px solid #e8e8e8;
        }
        .footer-left { display: table-cell; vertical-align: middle; }
        .footer-right { display: table-cell; vertical-align: middle; text-align: right; width: 80px; }
        .footer-note { font-size: 7.5px; color: #bbb; font-style: italic; }
        .footer-brand { font-size: 9px; font-weight: bold; color: #555; }
    </style>
</head>
<body>
<div class="wrap">

    {{-- BANNER --}}
    <div class="banner">
        <img src="{{ public_path('assets/images/logos/epd.jpeg') }}" alt="EPD 2026">
    </div>

    {{-- HEADER: event title + org --}}
    <div class="header">
        <div class="header-left">
            <div class="event-name">Payment Receipt &amp; Entry Ticket</div>
            <div class="event-sub">Environmental Protection Dialogue · EPD 2026 · Lusaka, Zambia</div>
        </div>
        <div class="header-right">
            <div class="org-info">
                Centre for Environmental Justice — Zambia<br>
                Plot 37741, Pitta Road, Ibex Hill, Lusaka<br>
                epd@cejzambia.org · +260 966 762215
            </div>
        </div>
    </div>

    {{-- STATUS BAR --}}
    <div class="statusbar">
        <div class="statusbar-left">
            <div class="ticket-code-label">Ticket Code</div>
            <div class="ticket-code">{{ $participant->ticket_code }}</div>
        </div>
        <div class="statusbar-right">
            <div class="status-pills">
                @php $statuses = $participant->product_status ?? []; @endphp
                @if(count($statuses))<div class="pill">{{ implode(', ', $statuses) }}</div>@endif
                <div class="pill">{{ $payment->status ?? 'N/A' }}</div>
            </div>
        </div>
    </div>

    {{-- MAIN BODY --}}
    <div class="body">

        {{-- LEFT COL: ticket + participant --}}
        <div class="col-left">

            <span class="sec">Ticket Details</span>
            <div class="g2">
                <div class="g2-row">
                    <div class="g2-cell">
                        <div class="lbl">Date Issued</div>
                        <div class="val">{{ date('d M Y') }}</div>
                    </div>
                    <div class="g2-cell">
                        <div class="lbl">Time</div>
                        <div class="val">{{ date('H:i:s') }}</div>
                    </div>
                </div>
                <div class="g2-row">
                    <div class="g2-cell">
                        <div class="lbl">Payment Method</div>
                        <div class="val">{{ $payment->payment_method ?? 'N/A' }}</div>
                    </div>
                    <div class="g2-cell">
                        <div class="lbl">Network (MNO)</div>
                        <div class="val">{{ $payment->mno ?? 'N/A' }}</div>
                    </div>
                </div>
                <div class="g2-row">
                    <div class="g2-cell">
                        <div class="lbl">Transaction Ref</div>
                        <div class="val-mono">{{ $payment->transaction_ref ?? 'N/A' }}</div>
                    </div>
                    <div class="g2-cell">
                        <div class="lbl">Paid At</div>
                        <div class="val">{{ $payment->paid_at ? $payment->paid_at->format('d M Y, H:i') : 'N/A' }}</div>
                    </div>
                </div>
            </div>

            <span class="sec">Participant</span>
            <div style="margin-bottom:6px;">
                <div class="lbl">Full Name</div>
                <div class="val-name">{{ $participant->name }}</div>
            </div>
            <div class="g2">
                <div class="g2-row">
                    <div class="g2-cell">
                        <div class="lbl">Email</div>
                        <div class="val">{{ $participant->email }}</div>
                    </div>
                    <div class="g2-cell">
                        <div class="lbl">Phone</div>
                        <div class="val">{{ $participant->phone }}</div>
                    </div>
                </div>
                <div class="g2-row">
                    <div class="g2-cell">
                        <div class="lbl">Organisation</div>
                        <div class="val">{{ $participant->organisation }}</div>
                    </div>
                    <div class="g2-cell">
                        <div class="lbl">Job Title</div>
                        <div class="val">{{ $participant->job_title }}</div>
                    </div>
                </div>
                <div class="g2-row">
                    <div class="g2-cell">
                        <div class="lbl">Province</div>
                        <div class="val">{{ $participant->province ?? '—' }}</div>
                    </div>
                    <div class="g2-cell">
                        <div class="lbl">District</div>
                        <div class="val">{{ $participant->district ?? '—' }}</div>
                    </div>
                </div>
            </div>

        </div>

        {{-- RIGHT COL: payment + QR --}}
        <div class="col-right">

            <span class="sec">Payment Details</span>
            <div class="g2">
                <div class="g2-row">
                    <div class="g2-cell">
                        <div class="lbl">Package</div>
                        <div class="val">{{ $participant->ticket_package }}</div>
                    </div>
                    <div class="g2-cell">
                        <div class="lbl">Category</div>
                        <div class="val">{{ $participant->delegate_category }}</div>
                    </div>
                </div>
                <div class="g2-row">
                    <div class="g2-cell">
                        <div class="lbl">Product</div>
                        <div class="val">{{ $participant->product ?? '—' }}</div>
                    </div>
                    <div class="g2-cell">
                        <div class="lbl">Currency</div>
                        <div class="val">{{ $participant->currency }}</div>
                    </div>
                </div>
            </div>

            <div class="amount-block">
                <div class="amount-label-cell">
                    <div class="amount-lbl">Total Amount Paid</div>
                </div>
                <div class="amount-val-cell">
                    <div class="amount-val">
                        <span class="amount-cur">{{ $participant->currency }}</span>{{ number_format($participant->amount, 2) }}
                    </div>
                </div>
            </div>

            <div class="qr-wrap">
                <div class="qr-frame">
                    <img src="{{ $qrPath }}" alt="QR Code">
                </div>
                <div class="qr-lbl">Scan to verify entry</div>
            </div>

        </div>
    </div>

    {{-- PERFORATION --}}
    <div class="perf"></div>

    {{-- STUB --}}
    <div class="stub">
        <div class="stub-cell">
            <div class="stub-lbl">Ticket</div>
            <div class="stub-code">{{ $participant->ticket_code }}</div>
        </div>
        <div class="stub-div"><div class="stub-div-line"></div></div>
        <div class="stub-cell">
            <div class="stub-lbl">Name</div>
            <div class="stub-val">{{ $participant->name }}</div>
        </div>
        <div class="stub-div"><div class="stub-div-line"></div></div>
        <div class="stub-cell">
            <div class="stub-lbl">Package</div>
            <div class="stub-val">{{ $participant->ticket_package }}</div>
        </div>
        <div class="stub-div"><div class="stub-div-line"></div></div>
        <div class="stub-cell">
            <div class="stub-lbl">Amount</div>
            <div class="stub-val">{{ $participant->currency }} {{ number_format($participant->amount, 2) }}</div>
        </div>
        <div class="stub-div"><div class="stub-div-line"></div></div>
        <div class="stub-cell">
            <div class="stub-lbl">Status</div>
            <div class="stub-val">{{ $payment->status ?? 'N/A' }}</div>
        </div>
        <div class="stub-div"><div class="stub-div-line"></div></div>
        <div class="stub-cell">
            <div class="stub-lbl">Date</div>
            <div class="stub-val">{{ date('d M Y') }}</div>
        </div>
        <div class="stub-cell-qr">
            <div class="stub-qr">
                <img src="{{ $qrPath }}" alt="QR">
            </div>
        </div>
    </div>

    {{-- FOOTER --}}
    <div class="footer">
        <div class="footer-left">
            <div class="footer-note">System-generated receipt · support@epd2026.org</div>
        </div>
        <div class="footer-right">
            <div class="footer-brand">EPD 2026</div>
        </div>
    </div>

</div>
</body>
</html>