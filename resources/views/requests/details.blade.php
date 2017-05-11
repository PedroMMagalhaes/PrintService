@extends ('layout.master')

@section ('content')


<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Detalhes do pedido</div>
  <div class="panel-body">

  <!-- Table -->
  <table class="table table-sm">
    <thead>
      <tr>
        <th>#</th>
        <th>Descrição</th>
        <th>Funcionário (nome, departamento, email, telefone)</th>
        <th>Data do pedido</th>
        <th>Cores ou Preto e Branco</th>
        <th>Frente e Verso ou Página Única</th>
        <th>Frente e Verso ou Página Única</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
      </tr>
    </tbody>
  </table>
</div>
  </div>

@endsection

@section ('footer')

@endsection
