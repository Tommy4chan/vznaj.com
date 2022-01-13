@foreach($questions as $el)
    <div class="alert alert-warning">
        <h3>{{ $el->title }}</h3>
        <b>{{ $el->subject_show }}</b>
        <p>{{ $el->text }}</p>
        <p>{{ ($el->created_at)->diffForHumans()}} </p>
        <a href="/task/{{$el->subject}}/{{$el->id}}">Перейти до завдання</a>
    </div>
@endforeach
