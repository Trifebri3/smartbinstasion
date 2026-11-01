<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BinFullAlertMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param array $binData
     * @param array $fullChambers
     * @param string $triggerType
     * @param string $triggeredBy
     */
    public function __construct(
        public array $binData,
        public array $fullChambers,
        public string $triggerType = 'automatic',
        public string $triggeredBy = 'Sensor Ultrasonik IoT Real-Time'
    ) {}

    /**
     * Get the message envelope.
     */
    public function Envelope(): Envelope
    {
        $stationCode = $this->binData['station_code'] ?? 'STATION';
        $stationName = $this->binData['name'] ?? 'SmartBin UIN SGD';
        $chambersStr = !empty($this->fullChambers) ? implode(', ', $this->fullChambers) : 'Kapasitas Kritis';

        return new Envelope(
            subject: "⚠️ [PERINGATAN] TEMPAT SAMPAH SUDAH PENUH - SEGERA AMBIL! ({$stationName} - {$stationCode})",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.bin-full-alert',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

