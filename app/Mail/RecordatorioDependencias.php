<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;

class RecordatorioDependencias extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dependencia, $entidad, $numero_solicitud, $anio, $email, $nombre, $fecha, $descripcion)
    {
        $this->dependencia      = $dependencia;
        $this->entidad          = $entidad;
        $this->numero_solicitud = $numero_solicitud;
        $this->anio             = $anio;
        $this->email            = $email;
        $this->nombre           = $nombre;
        $this->fecha            = $fecha;
        $this->descripcion      = $descripcion;
        $this->subject          = 'Recordatorio informe de solicitud';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email            = $this->email;
        $entidad          = $this->entidad;
        $numero_solicitud = $this->numero_solicitud;
        $anio             = $this->anio;
        $nombre           = $this->nombre;
        $fecha            = $this->fecha;
        $descripcion      = $this->descripcion;
        return $this->view('mails.recordatorio_dependencias', compact('email', 'entidad', 'numero_solicitud', 'anio', 'nombre', 'fecha', 'descripcion'));
    }
}
