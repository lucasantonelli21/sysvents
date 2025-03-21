Olá {{$name}}, Como vai?
<br/>
Estamos te enviando este e-mail para lembrar que o evento {{$event->name}} está chegando.<br/>
O evento acontecerá de {{ formatDate($event->start_date, 'd/m/Y') }} até {{ formatDate($event->end_date,'d/m/Y') }} e o você possui{{ $event->total_tickets }} {{ $event->total_tickets > 1 ? ' ingressos' : 'ingresso' }}.<br/>
Esperamos te ver lá!<br/>
Atenciosamente, Equipe do Evento.