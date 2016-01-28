@section('content')
<link rel="stylesheet" href="{{Request::root()}}/assets/frontend/css/stat.css">

<div class="row">
    <div class="col-md-12">
        <div class="box">
             <!--  <div class="box-header">
             <h3 class="box-title"></h3>
                     <div class="box-tools">
                        <div class="input-group">
                            <input type="text" name="table_search" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div> --> <!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="col-md-12">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                     @foreach($surveys as $key => $survey)
                     <div class="panel panel-default">
                      <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                          <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$survey->id}}" aria-expanded="true" aria-controls="collapse{{$survey->id}}">
                           Anketa {{$survey->id}}: Semestar - {{($survey->semester===1)? 'zimski' : 'letnji'}}, Godina - {{$survey->year}}
                           {{($survey->active===0)? '<span class="pull-right text-danger">Neaktivna</span>' : '<span class="pull-right text-success">Aktivna</span>'}}
                       </a>
                   </h4>
               </div>
               <div id="collapse{{$survey->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                  <div class="panel-body">
                    <div class="list-group">
                      <div class="list-group-item">
                        <a href="{{_l(URL::action('Ps_surveys@getReport1').'/'.$survey->id)}}" target="_blank">
                          Izvestaj 1
                      </a>
                      <div><h3>U ovom izveštaju: </h3>
                          <ul>
                            <li>Konkretni rezultati po pitanjima prema predmetima,godinama, smerovima i zbirno</li>
                            <li>Rezultati u procentualnom i brojevnom obliku</li>
                            <li>Jednostavna vizuelizacija odgovora za svaki predmet,smer,godinu i zbirno</li>
                            <li>Mogućnost filtriranja rezultata prema godinama i smerovima</li>
                        </ul>
                    </div>
                </div>
                <div class="list-group-item">
                                    <a href="{{_l(URL::action('Ps_surveys@getReport2').'/'.$survey->id)}}" target="_blank">
                    Izvestaj 2
                </a>
                <div><h3>U ovom izveštaju: </h3>
                  <ul>
                    <li>Podaci o samoj anketi</li>
                    <li>Vremenski grafikon sa popunama</li>
                    <li>Upoređivanje popuna prema smeru, godini studija i zbirno</li>
                    <li>Tabelarni prikaz svih popuna, sa datumom, smerom, godinom studija i spiskom popunjenih predmeta</li>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endforeach

</div>

</div>
</div><!-- /.box-body -->
</div><!-- /.box -->        
</div>
</div>
@stop