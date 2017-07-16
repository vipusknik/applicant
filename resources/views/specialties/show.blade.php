@extends ('layouts.base')

@section ('title')
  Специальность {{ $specialty->title }}
@endsection

@section ('content')
<div id="subpage">
    <div style="width:655px;">
        <h1> Специальность "{{ $specialty->title }}" </h1>
    </div>
    <div class="ui very relaxed grid">
        <div class="ten wide column">
            <div class="ui grid">
                @if ($specialty->code)
                  <div class="three wide column">
                      <h5 class="ui header">Код:</h5>
                      <div class="content">{{ $specialty->code }}</div>
                  </div>
                @endif
                @if ($specialty->subjects->count() == 2)
                  <div class="six wide column">
                      <h5 class="ui header">Профильные предметы:</h5>
                      <div class="content">
                          {{ $specialty->subjects[0]->title }}, {{ $specialty->subjects[1]->title }}
                      </div>
                  </div>
                @endif
                @isset($specialty->direction)
                  <div class="seven wide column">
                      <h5 class="ui header">Наравление:</h5>
                      <div class="content">
                          <a href="{{ route('specialties.index', $specialty->direction)}}">
                            {{ $specialty->direction->title }}
                          </a>
                      </div>
                  </div>
                @endisset
            </div>
            <br>
            <div class="ui divider"></div>
            @if ($specialty->description)
              {!! $specialty->description !!}
            <br>
            @endif
            <br>
        </div>
        <div class="one wide column"></div>
        <div class="five wide column" style="position: absolute; right: 35px; top: 190px;">
            <div class="ui segment" style="margin-top:-175px;">
                <H3>Где учиться?</H3>
                <a href=""
                   class="header">
                  Учебные заведения
                </a>
            </div>
            <div class="ui segment">
                <div class="eleven wide column">
                    <h3 style="margin-bottom: 33px;">Связанные Профессии</h3>
                </div>
                <div class="ui very relaxed divided list">
                    <div class="item">
                        <div class="content">
                            @foreach ($specialty->professions as $profession)
                              <a href="{{ route('professions.show', $profession) }}"
                                 class="header">
                              <i class="small teal travel middle aligned icon"></i>
                              {{ $profession->title }}</a><br>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
</div>
@endsection
