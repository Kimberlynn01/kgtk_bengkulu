@component('mail::message')
Jawaban Pertanyaan Q&A
Halo {{ $qna->name }},
Terima kasih telah menghubungi kami. Pertanyaan Anda mengenai kategori {{ strtoupper($qna->category) }} telah
dijawab oleh admin kami.
@component('mail::panel')
Pertanyaan Anda:
{{ $qna->question }}
@endcomponent
Jawaban Kami:
{{ $qna->answer }}
@component('mail::button', ['url' => config('app.url'), 'color' => 'primary'])
Kunjungi Website
@endcomponent
Jika Anda memiliki pertanyaan lebih lanjut, jangan ragu untuk membalas email ini atau membuat tiket pertanyaan baru di
website kami.
Salam hangat,<br>
{{ config('app.name') }}
@endcomponent
