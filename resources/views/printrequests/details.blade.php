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
        <th>Data do pedido</th>
        <th>Cores ou Preto e Branco</th>
        <th>Tipo de impressão</th>
        <th>Agravado?</th>
        <th>Dimensão do papel</th>
        <th>Tipo do papel</th>
        <th>Link para o ficheiro</th>
        <th>Estado do pedido</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">{{$dados->description}}</th>
        <td>{{$dados->created_at}}</td>
        <td><?php
        if($dados->colored == 1)
        echo("Cores");
        else echo ("Preto e Branco");
             ?></td>
        <td><?php
        if($dados->front_back == 1)
        echo("Frente e Verso");
        else echo ("Página Unica");
             ?></td>
        <td><?php
        if($dados->stapled == 1)
        echo("Sim");
        else echo ("Não");
             ?>a</td>
        <td>{{$dados->paper_size}}</td>
        <td>{{$dados->paper_type}}</td>
        <td>{{$dados->file}}</td>
        <td><?php
        if($dados->status == 1)
        echo("Completo");
        else echo ("A processar");
             ?></td>
      </tr>
    </tbody>
  </table>
</div>
  </div>

@endsection

@section ('footer')

@endsection
