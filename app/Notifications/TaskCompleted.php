<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\DatabaseNotification;


use App\Actividad;
use App\Comentario;
use DB;
use App\User;

class TaskCompleted extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {

        $proyecto_id = \Session::get('proyecto_id');
        $actividad_id = \Session::get('actividad_id');
        //$parent_id = \Session::get('parent_id');

        
        
        $last_comment_id = Comentario::latest()->first()->id;

        //dd($last_comment_id);

        $parent_id = Comentario::where('id', '=', $last_comment_id)->get()->first()->parent_id;
        $name = Comentario::where('id', '=', $last_comment_id)->get()->first()->name;

        //dd($parent_id);

        if (is_null($parent_id)){
            $usuario_id = auth()->user()->id;
            $users_id = Actividad::where('id', '=', $actividad_id)->get()->first()->users_id;            
        }else{
            $users_id = Comentario::where('parent_id', '=', null)
                                    ->where('actividad_id', '=', $actividad_id)
                                    ->get()->first()->users_id;
            $usuario_id = $users_id;
        }

        //dd($usuario_id);

        //$data = array('proyecto_id'=>$proyecto_id, 'actividad_id'=>$actividad_id);

        //$data_json = json_encode($data);

        

        // DatabaseNotification::create([
        //     'id'              => '100',
        //     'type'            => 'App\Notifications\TaskCompleted',
        //     'data'            => $data_json,
        //     'read_at'         => null,
        //     'notifiable_id'   => 0,
        //     'notifiable_type' => 'App\User'            
        // ]);

            DB::table('notifications')
            ->where('notifiable_id', auth()->user()->id)
            ->update(['notifiable_id' => $users_id]);          

            //$name = User::where('id', '=', $usuario_id)->get()->first()->name;
            $num_ticket = Actividad::where('id', '=', $actividad_id)->get()->first()->numero_ticket;     
            
            //dd($num_ticket);

        return [
            //
            //'data' => 'https://www.em.com.sv/proyecto/'.$proyecto_id.'/'.$actividad_id,
            'data' => 'http://localhost:8000/proyecto/'.$proyecto_id.'/'.$actividad_id,
            'users_id' => $users_id,
            'notifiable_id' => $users_id,
            'name' => $name,
            'num_ticket' => $num_ticket,
            'actividad_id' => $actividad_id,
        ];

    }
}
