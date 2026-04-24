<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>EPD2026 Receipt</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: Calibri, Arial, sans-serif;
            font-size: 12px;
            color: #111;
            background: #ccc;
            padding: 24px;
        }

        @media print {
            body { background: white; padding: 0; }
            .ticket-wrapper { box-shadow: none; }
            .perf-circle { background: white !important; }
        }

        .ticket-wrapper {
            max-width: 780px;
            margin: 0 auto;
            background: #fff;
            border: 1px solid #999;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        }

        /* BANNER */
        .banner img {
            width: 100%;
            height: 105px;
            object-fit: cover;
            object-position: center 30%;
            display: block;
        }

        /* ORG STRIP */
        .org-strip {
            background: #111;
            padding: 7px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }
        .org-name {
            color: #fff;
            font-size: 11px;
            font-weight: bold;
        }
        .org-contact {
            font-size: 9px;
            color: #aaa;
            text-align: right;
            line-height: 1.6;
        }

        /* TITLE ROW */
        .title-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 24px 10px;
            border-bottom: 2px solid #111;
        }
        .doc-title {
            font-size: 18px;
            font-weight: bold;
            color: #111;
        }
        .doc-sub {
            font-size: 9px;
            color: #777;
            margin-top: 2px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .status-block {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 4px;
        }
        .pill {
            display: inline-block;
            padding: 2px 10px;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: 1.5px solid #111;
            color: #111;
        }

        /* BODY */
        .body-wrap {
            display: grid;
            grid-template-columns: 1fr 148px;
        }
        .body-main {
            padding: 18px 24px;
            border-right: 1px dashed #ccc;
        }

        /* SECTIONS */
        .section { margin-bottom: 16px; }
        .section:last-child { margin-bottom: 0; }

        .section-title {
            display: block;
            font-size: 8.5px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #666;
            margin-bottom: 8px;
            padding-bottom: 4px;
            border-bottom: 1px solid #ddd;
        }

        /* GRIDS */
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 8px 18px; }
        .grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 8px 12px; }
        .span-2 { grid-column: span 2; }

        .lbl {
            font-size: 8.5px;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 1px;
        }
        .val {
            font-size: 12px;
            font-weight: bold;
            color: #111;
            line-height: 1.3;
        }
        .val-lg {
            font-size: 15px;
            font-weight: bold;
            color: #111;
        }
        .val-mono {
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        /* PAYMENT BOX */
        .payment-box {
            background: #f7f7f7;
            border: 1px solid #ddd;
            border-top: 2px solid #111;
            padding: 11px 13px;
        }
        .amount-row {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #ccc;
        }
        .amount-lbl {
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #777;
        }
        .amount-val {
            font-size: 22px;
            font-weight: bold;
            color: #111;
        }
        .amount-currency {
            font-size: 11px;
            font-weight: bold;
            color: #555;
            margin-right: 3px;
        }

        /* QR */
        .qr-panel {
            padding: 18px 14px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 7px;
        }
        .qr-frame {
            border: 1.5px solid #111;
            padding: 5px;
            background: #fff;
        }
        .qr-frame img {
            width: 108px;
            height: 108px;
            display: block;
        }
        .qr-label {
            font-size: 8px;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            text-align: center;
        }
        .qr-code-text {
            font-family: 'Courier New', Courier, monospace;
            font-size: 8px;
            color: #555;
            text-align: center;
            word-break: break-all;
            line-height: 1.4;
        }

        /* PERFORATION */
        .perf-wrap {
            position: relative;
            height: 1px;
            background: repeating-linear-gradient(90deg, #bbb 0, #bbb 6px, transparent 6px, transparent 12px);
        }
        .perf-circle {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 16px;
            height: 16px;
            background: #ccc;
            border-radius: 50%;
        }
        .perf-left  { left: -8px; }
        .perf-right { right: -8px; }

        /* ID BAR */
        .id-bar {
            background: #111;
            padding: 9px 24px;
            display: flex;
            align-items: center;
            gap: 18px;
        }
        .id-bar-sep {
            width: 1px;
            height: 20px;
            background: #444;
            flex-shrink: 0;
        }
        .id-bar-lbl {
            font-size: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #666;
        }
        .id-bar-code {
            font-family: 'Courier New', Courier, monospace;
            font-size: 15px;
            color: #fff;
            letter-spacing: 2px;
            font-weight: bold;
        }
        .id-bar-name {
            font-size: 11px;
            color: #aaa;
        }
        .id-bar-date-val {
            font-size: 10px;
            color: #aaa;
        }
        .id-bar-right { margin-left: auto; text-align: right; }

        /* FOOTER */
        .footer {
            background: #f7f7f7;
            border-top: 1px solid #ddd;
            padding: 7px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .footer-note {
            font-size: 8.5px;
            color: #888;
            font-style: italic;
        }
        .footer-brand {
            font-size: 10px;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
<div class="ticket-wrapper">

    {{-- BANNER --}}
    <div class="banner">
        <img src="{{ public_path('assets/images/logos/epd.jpeg') }}" alt="EPD2026">
    </div>

    {{-- ORG STRIP --}}
    <div class="org-strip">
        <div class="org-name">Centre for Environmental Justice — Zambia</div>
        <div class="org-contact">
            Plot No. 37741, Pitta Road, Off Twin Palm Road, Ibex Hill, Lusaka – Zambia &nbsp;·&nbsp;
            epd@cejzambia.org &nbsp;·&nbsp; +260 966 762215 / +260 971 479976
        </div>
    </div>

    {{-- TITLE + STATUS --}}
    <div class="title-row">
        <div>
            <div class="doc-title">Payment Receipt &amp; Entry Ticket</div>
            <div class="doc-sub">Environmental Protection Dialogue · EPD 2026 · Lusaka, Zambia</div>
        </div>
        <div class="status-block">
            @php
                $statuses = $participant->product_status ?? [];
            @endphp
            @if(count($statuses))
                <div class="pill">{{ implode(', ', $statuses) }}</div>
            @endif
            <div class="pill">{{ $payment->status ?? 'N/A' }}</div>
        </div>
    </div>

    {{-- BODY --}}
    <div class="body-wrap">
        <div class="body-main">

            {{-- TICKET REFERENCE --}}
            <div class="section">
                <span class="section-title">Ticket Reference</span>
                <div class="grid-4">
                    <div class="span-2">
                        <div class="lbl">Ticket Code</div>
                        <div class="val val-mono" style="font-size:14px;">{{ $participant->ticket_code }}</div>
                    </div>
                    <div>
                        <div class="lbl">Date Issued</div>
                        <div class="val">{{ date('d M Y') }}</div>
                    </div>
                    <div>
                        <div class="lbl">Time</div>
                        <div class="val">{{ date('H:i:s') }}</div>
                    </div>
                    <div class="span-2">
                        <div class="lbl">Transaction Reference</div>
                        <div class="val val-mono" style="font-size:10.5px;">{{ $payment->transaction_ref ?? 'N/A' }}</div>
                    </div>
                    <div>
                        <div class="lbl">Payment Method</div>
                        <div class="val">{{ $payment->payment_method ?? 'N/A' }}</div>
                    </div>
                    <div>
                        <div class="lbl">Network (MNO)</div>
                        <div class="val">{{ $payment->mno ?? 'N/A' }}</div>
                    </div>
                    <div class="span-2">
                        <div class="lbl">Paid At</div>
                        <div class="val">{{ $payment->paid_at ? $payment->paid_at->format('d M Y · H:i') : 'N/A' }}</div>
                    </div>
                </div>
            </div>

            {{-- PARTICIPANT --}}
            <div class="section">
                <span class="section-title">Participant Information</span>
                <div class="grid-2">
                    <div class="span-2">
                        <div class="lbl">Full Name</div>
                        <div class="val-lg">{{ $participant->name }}</div>
                    </div>
                    <div>
                        <div class="lbl">Email Address</div>
                        <div class="val">{{ $participant->email }}</div>
                    </div>
                    <div>
                        <div class="lbl">Phone Number</div>
                        <div class="val">{{ $participant->phone }}</div>
                    </div>
                    <div>
                        <div class="lbl">Organisation</div>
                        <div class="val">{{ $participant->organisation }}</div>
                    </div>
                    <div>
                        <div class="lbl">Job Title / Designation</div>
                        <div class="val">{{ $participant->job_title }}</div>
                    </div>
                    <div>
                        <div class="lbl">Province</div>
                        <div class="val">{{ $participant->province ?? '—' }}</div>
                    </div>
                    <div>
                        <div class="lbl">District</div>
                        <div class="val">{{ $participant->district ?? '—' }}</div>
                    </div>
                </div>
            </div>

            {{-- PAYMENT --}}
            <div class="section">
                <span class="section-title">Payment Details</span>
                <div class="payment-box">
                    <div class="grid-2">
                        <div>
                            <div class="lbl">Package</div>
                            <div class="val">{{ $participant->ticket_package }}</div>
                        </div>
                        <div>
                            <div class="lbl">Delegate Category</div>
                            <div class="val">{{ $participant->delegate_category }}</div>
                        </div>
                        <div>
                            <div class="lbl">Product</div>
                            <div class="val">{{ $participant->product ?? '—' }}</div>
                        </div>
                        <div>
                            <div class="lbl">Currency</div>
                            <div class="val">{{ $participant->currency }}</div>
                        </div>
                    </div>
                    <div class="amount-row">
                        <div class="amount-lbl">Total Amount Paid</div>
                        <div class="amount-val">
                            <span class="amount-currency">{{ $participant->currency }}</span>{{ number_format($participant->amount, 2) }}
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- QR --}}
        <div class="qr-panel">
            <div class="qr-frame">
                <img src="{{ $qrPath }}" alt="QR Code">
            </div>
            <div class="qr-label">Scan to Verify</div>
            <div class="qr-code-text">{{ $participant->ticket_code }}</div>
        </div>
    </div>

    {{-- PERFORATION --}}
    <div class="perf-wrap">
        <div class="perf-circle perf-left"></div>
        <div class="perf-circle perf-right"></div>
    </div>

    {{-- ID BAR --}}
    <div class="id-bar">
        <div>
            <div class="id-bar-lbl">Ticket Code</div>
            <div class="id-bar-code">{{ $participant->ticket_code }}</div>
        </div>
        <div class="id-bar-sep"></div>
        <div>
            <div class="id-bar-lbl">Participant</div>
            <div class="id-bar-name">{{ $participant->name }}</div>
        </div>
        <div class="id-bar-sep"></div>
        <div class="id-bar-right">
            <div class="id-bar-lbl">Issued</div>
            <div class="id-bar-date-val">{{ date('d M Y') }}</div>
        </div>
    </div>

    {{-- FOOTER --}}
    <div class="footer">
        <div class="footer-note">System-generated receipt · For support contact support@epd2026.org</div>
        <div class="footer-brand">EPD 2026</div>
    </div>

</div>
</body>
</html>