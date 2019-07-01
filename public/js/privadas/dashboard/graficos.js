var cores = {
  promotores: '#00c252',
  neutros: 'rgb(11, 98, 164)',
  detratores: '#DC143C'
}
function contarDiasComDados(dados){
  var diasComDados = 0;
  var datas = [];
  for (var i = 0; i < dados.length; i++) {
    if ($.inArray(moment(dados[i].data).format('YYYY-MM-DD'),datas) < 0) {
      diasComDados++;
      datas.push(moment(dados[i].data).format('YYYY-MM-DD'));
    }
  }
  return diasComDados;
}
function todosObjetosVazios(array,valueKey) {
  var tudoVazio = true;
  for (var i = 0; i < array.length; i++) {
    if (array[i][valueKey]) {
      return false;
    }
  }
  return tudoVazio;
}
function esconderMostrarAlertas(dados, semData = false, verObjectValue = false, valueKey = '', especifico = false, objetoDOM = []) {
  if (especifico === false) {
    if (semData === false) {
      diasComDados = contarDiasComDados(dados);
      esconderMostrarElementos(diasComDados > 2);
    } else if (semData === true) {
      esconderMostrarElementos(dados.length > 0);
    }
  } else {
    if (semData === true) {
      if (verObjectValue === true) {
        for (var i = 0; i < dados.length; i++) {
          var vazio = todosObjetosVazios(dados[i],'quantidade');
          esconderMostrarElementos(!vazio,especifico,objetoDOM[i]);
        }
      }
    }
  }
}
function esconderMostrarElementos(validador, especifico = false, objetoDOM = '') {
  if (especifico === false) {
    if (validador) {
      $('.alerta-coleta-3-dias').each(function(){
        $(this).hide();
      });
      $('.grafico').each(function(){
        $(this).show();
      });
    } else {
      $('.alerta-coleta-3-dias').each(function(){
        $(this).show();
      });
      $('.grafico').each(function(){
        $(this).hide();
      });
    }
  } else {
    if (validador) {
      $(objetoDOM).prev().hide();
      $(objetoDOM).show();
    } else {
      $(objetoDOM).prev().show();
      $(objetoDOM).hide();
    }
  }
}
function mediaMovel(dados,t,dataKey,valueKeys) {  //dados = [{data,value1,value2,value3...},...]
  //OBS: os dados já tem que estar ordenados em relação à data
  //OBS: t é o valor em dias
  //Verificando se os 'valueKeys' passados estão no formato de uma array
  if (!(valueKeys.constructor === Array)) {
    valueKeys = [valueKeys];
  }
  //Inicializando variáveis
  var mM = [];
  var buffer = [];
  for (var i = 0; i < dados.length; i++) {
    if (i == 0) { //Apenas guardar o primeiro valor
      var tempObj = {};
      tempObj[dataKey] = dados[0][dataKey];
      for (var j = 0; j < valueKeys.length; j++) {  //percorrendo todos os possíveis keys para valores
        tempObj['mM'+valueKeys[j]] = dados[0][valueKeys[j]];
      }
      buffer.push(tempObj);
      mM.push(tempObj);
    } else {
      //primeiro vamos guardar os valores dentro do buffer
      var tempObj = {};
      tempObj[dataKey] = dados[i][dataKey];
      for (var j = 0; j < valueKeys.length; j++) {
        tempObj['mM' + valueKeys[j]] = dados[i][valueKeys[j]];
      }
      buffer.push(tempObj);
      //Fazendo o somatório dos valores dentro do buffer
      var soma = {};
      //Inicializando o valor de 'soma' com zero
      for (var j = 0; j < valueKeys.length; j++) {
        soma[valueKeys[j]] = 0;
      }
      for (var j = 0; j < buffer.length; j++) {
        for (var k = 0; k < valueKeys.length; k++) {
          soma[valueKeys[k]] = soma[valueKeys[k]] + buffer[j]['mM' + valueKeys[k]];
        }
      }
      //Divindo a somatória pelo tamanho do buffer
      for (var j = 0; j < valueKeys.length; j++) {
        soma[valueKeys[j]] = soma[valueKeys[j]]/buffer.length;
      }
      //Criando um objeto para ser empurrado para dentro da array
      var tempObj = {};
      tempObj[dataKey] = dados[i][dataKey];
      for (var j = 0; j < valueKeys.length; j++) {
        tempObj['mM'+valueKeys[j]] = soma[valueKeys[j]].toFixed(2);
      }
      //Empurrando para dentro da array
      mM.push(tempObj);
    }
    //Se o buffer exceder o número de dias para ser considerado na média móvel, retirar valores velhos
    if ((buffer[buffer.length - 1].data.getTime() - buffer[0].data.getTime()) > t*24*60*60*1000) {
      while ((buffer[buffer.length - 1].data.getTime() - buffer[0].data.getTime()) > t*24*60*60*1000) {
        buffer.shift();
      }
    }
  }
  return mM;
}
function apenasUltimaNota(dados,idKey,tabelaIncompleta = false,valueKeys = []) {
  //Verificando se os 'valueKeys' passados estão no formato de uma array
  if (!(valueKeys.constructor === Array)) {
    valueKeys = [valueKeys];
  }
  //Função só funciona se dados já estiverem ordenados em relação à data
  var arrayID = [];
  var resultado = [];
  for (var i = dados.length - 1; i >= 0; i--) {
    if (($.inArray(dados[i][idKey],arrayID)) < 0) {
      resultado.unshift(dados[i]);
      arrayID.push(dados[i][idKey]);
    } else {
      if (tabelaIncompleta) {
        for (var j = 0; j < resultado.length; j++) {
          if (resultado[j][idKey] == dados[i][idKey]) {
            for (var k = 0; k < valueKeys.length; k++) {
              if ((!(resultado[j][valueKeys[k]])) && ((dados[i][valueKeys[k]]))) {
                resultado[j][valueKeys[k]] = dados[i][valueKeys[k]];
              }
            }
            break;
          }
        }
      }
    }
  }
  return resultado;
}
function calcularNPS(dados,valueKey) {
  var promotores = 0;
  var detratores = 0;
  var neutros = 0;
  for (var i = 0; i < dados.length; i++) {
    if (dados[i][valueKey] >= 9) {
      promotores++;
    } else if (dados[i][valueKey] <= 6) {
      detratores++;
    } else {
      neutros++;
    }
  }
  var nota = parseInt(((promotores - detratores)/dados.length)*100);
  var agrupado = [
    {label: 'promotores', value: promotores},
    {label: 'detratores', value: detratores},
    {label: 'neutros', value: neutros}
  ];
  return {'nota': nota, 'agrupado': agrupado};
}
function agrupar(dados,valueKey,groupItens) {
  var resultado = [];
  //Verificando se os 'groupItens' passados estão no formato de uma array
  if (!(groupItens.constructor === Array)) {
    groupItens = [groupItens];
  }
  for (var i = 0; i < groupItens.length; i++) {
    resultado.push({
      valor: groupItens[i],
      quantidade: 0
    });
  }
  for (var i = 0; i < dados.length; i++) {
    for (var j = 0; j < resultado.length; j++) {
      if (resultado[j].valor == dados[i][valueKey]) {
        resultado[j].quantidade++;
      }
    }
  }
  return resultado;
}
function mediaMovelNPS(dados,t,dataKey,valueKey) {
  var buffer = [];
  var mM = [];
  for (var i = 0; i < dados.length; i++) {
    if (i === 0){
      buffer.push(dados[0]);
      mM.push({[dataKey]: dados[0][dataKey], ['mM' + valueKey]: calcularNPS(buffer,valueKey).nota});
    } else {
      buffer.push(dados[i]);
      mM.push({[dataKey]: dados[i][dataKey], ['mM' + valueKey]: calcularNPS(buffer,valueKey).nota});
    }
    //Se o buffer exceder o número de dias para ser considerado na média móvel, retirar valores velhos
    if ((buffer[buffer.length - 1][dataKey].getTime() - buffer[0][dataKey].getTime()) > t*24*60*60*1000) {
      while ((buffer[buffer.length - 1][dataKey].getTime() - buffer[0][dataKey].getTime()) > t*24*60*60*1000) {
        buffer.shift();
      }
    }
  }
  return mM;
}
function contarIdades(dados,valueKey) {
  resultado = [];
  var idade = 0;
  for (var i = 0; i < dados.length; i++) {
    idade = moment().diff(dados[i][valueKey]);
    idade = Math.floor(idade/(1*1000*60*60*24*365));
    resultado.push({
      idade: idade,
    });
  }
  return resultado;
}
