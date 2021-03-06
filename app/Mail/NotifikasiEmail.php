<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifikasiEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->datas = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->from('do-not-reply@hrpepc', 'HR PEPC')
                    ->subject($this->datas['subject'])
                    ->view($this->datas['templates'])
                    ->with(
                        [
                            'id_request'=>$this->datas['id_request'],
                            'nomor_request'=>$this->datas['no_request'],
                            'tgl_request'=>$this->datas['tgl_request'],
                            'status'=>$this->datas['status'],
                            'layanan'=>$this->datas['layanan'],
                            'permintaan'=>$this->datas['permintaan'],
                            'resolution_notes'=>$this->datas['resolution_notes'],
                            'confirmation_notes'=>$this->datas['confirmation_notes']
                        ]
                    );
        // sendemail standard (without attachment)
        /*return $this->from('skurniawan@marthana.co.id')
                   ->view('notif_email_request')
                   ->with(
                    [
                        'nama' => 'Sigit Kurniawan',
                        'website' => 'www.cordovastore.com',
                    ]);*/
        // sendemail standard (with attachment)
        /*return $this->from('pengirim@malasngoding.com')
                   ->view('emailku')
                   ->with(
                    [
                        'nama' => 'Diki Alfarabi Hadi',
                        'website' => 'www.malasngoding.com',
                    ])
                    ->attach(public_path('/hubungkan-ke-lokasi-file').'/demo.jpg', [
                      'as' => 'demo.jpg',
                      'mime' => 'image/jpeg',
                    ]);   */
    }
}
