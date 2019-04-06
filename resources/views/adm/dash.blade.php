<div class="container ">
    <div class="row justify-content-center">
        <div class="col-md-8 shadow p-3 mb-5 bg-white rounded">
            <div class="panel panel-primary ">
            <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-dark rounded box-shadow">
                <div class="lh-100">
                <h3 class="mb-0 text-white lh-100">Dashboard administrativo.</h3>
                <small>Bem vindo, {{ Auth::user()->name }}</small>
                </div>
            </div>
            <hr>
                <div class="panel-body">
                    <div class="d-flex justify-content-center">
                        <div class="col-xs-12 ">
                          <a href="{{route('area.index')}}" class="btn btn-danger btn-lg" role="button"><i class="fas fa-globe-americas" style="font-size: 2rem;"></i> <br/>Áreas</a>
                          <a href="{{route('listar.diretriz')}}" class="btn btn-warning btn-lg" role="button"><i class="far fa-question-circle" style="font-size: 2rem;"></i> <br/>Diretrizes</a>
                          <a href="{{route('atribuir')}}" class="btn btn-primary btn-lg" role="button"><i class="fas fa-project-diagram" style="font-size: 2rem;"></i> <br/>Projetos</a>
                          <a href="{{route('qperfil.index')}}" class="btn btn-secondary btn-lg" role="button"><i class="fas fa-users" style="font-size: 2rem;"></i> <br/>Perfil</a>
                          <a href="{{route('selecao')}}" class="btn btn-success btn-lg" role="button"><i class="fas fa-chart-bar" style="font-size: 2rem;"></i> <br/>Índice iREAM</a>
                          
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>