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
        <th>Descrição</th>
        <th>Funcionário (nome, departamento, email, telefone)</th>
        <th>Data do pedido</th>
        <th>Cores ou Preto e Branco</th>
        <th>Frente e Verso ou Página Única</th>
        <th>Agravado?</th>
        <th>Dimensão do papel</th>
        <th>Tipo do papel</th>
        <th>Link para o ficheiro</th>
        <th>Estado do pedido</th>


      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">1</th>
        <td>Descrição</td>
        <td>Funcionário (nome, departamento, email, telefone)</td>
        <td>Data do pedido</td>
        <td>Cores ou Preto e Branco</td>
        <td>Frente e Verso ou Página Única</td>
        <td>Agravado?</td>
        <td>Dimensão do papel</td>
        <td>Tipo do papel</td>
        <td>Link para o ficheiro</td>
        <td>Estado do pedido</td>
      </tr>
    </tbody>
  </table>
</div>
  </div>

@endsection

@section ('footer')

@endsection
