const nombreCiudad = document.querySelector('#dist-panel-nombre');
const latitudGrados = document.querySelector('#dist-panel-latitud-grados');
const latitudMinutos = document.querySelector('#dist-panel-latitud-minutos');
const alturaPanel = document.querySelector('#dist-panel-altura');
const resultado = document.querySelector('#dist-panel-resultados')
const btn = document.querySelector('#dist-panel-btn')
const form = document.querySelector('#dist-panel-formulario')


form.addEventListener('submit', (e)=>{
    e.preventDefault();
    const grados = latitudGrados.value;
    const minutos = latitudMinutos.value;
    if (parseFloat(grados)>90 || parseFloat(grados)<0){
        resultado.classList.remove('dist-panel-resultados-display');
        resultado.innerHTML=`El valor de los Grados de la latitud debe ser positivo y menor que 90`;
    } else if(parseFloat(minutos)>59 || parseFloat(minutos)<0){
        resultado.classList.remove('dist-panel-resultados-display');
        resultado.innerHTML=`El valor de los Grados de la latitud debe ser positivo y menor que 60`;
    } else {
        //console.log(nombreCiudad.value , alturaPanel.value );
    const ciudad = nombreCiudad.value;
    const lat = calcularLatitud(latitudGrados.value , latitudMinutos.value );
    const inclinacion = (calcularInclinacion(lat)).toFixed(2);
    const alturaSol = alturaSolar(lat);
    const altura = alturaPanel.value;
    console.log(lat, alturaSol, inclinacion);
    const distanciaPaneles = (calcularDistanciaPaneles(altura, alturaSol, inclinacion)/ parseFloat(1000)).toFixed(2);
    const pasillo = (distanciaPaneles - (altura * Math.cos(gradosARadianes(inclinacion)))/parseFloat(1000)).toFixed(2);
    console.log(distanciaPaneles);
    resultado.classList.remove('dist-panel-resultados-display');
    resultado.innerHTML=`La distancia entre filas de paneles solares foltovoltaicos de <span class="dist-panel-tag-resultado">${altura} mm</span> de altura instalados  en <span class="dist-panel-tag-resultado">${ciudad}</span>, debe ser de un mínimo de <span class="dist-panel-tag-resultado">${distanciaPaneles} metros</span>.<br/>Los paneles se instalarán con una inclinación de unos <span class="dist-panel-tag-resultado">${inclinacion}º</span> con la horizontal.`;
    resultado.innerHTML=`Ciudad: <span class="dist-panel-tag-resultado">${ciudad}</span><br/>Altura (L) panel Instalado: <span class="dist-panel-tag-resultado">${altura} mm</span><br/>Distancia (D) entre paneles: <span class="dist-panel-tag-resultado">${distanciaPaneles} metros</span><br/>Pasillo (d) entre filas de paneles: <span class="dist-panel-tag-resultado">${pasillo} metros</span><br/>Inclinación (A) de los paneles: <span class="dist-panel-tag-resultado">${inclinacion}º</span> con la horizontal.`;

    }
    
    
})


function calcularLatitud(x, y){
    let n1 = parseFloat(x);
    let n2 = parseFloat(y);
    let min = parseFloat((n2/60).toFixed(2));
    return n1 + min;
}

function alturaSolar(lat){
    return parseFloat(67)-parseFloat(lat);
}

function calcularInclinacion(x){
    return parseFloat(3.7) + parseFloat((0.69 * x).toFixed(2));
}

function calcularDistanciaPaneles(l, h, i){
    let radIncli = gradosARadianes(i);
    let altSol = gradosARadianes(h);
    //console.log(radIncli, altSol)
    
    return (parseFloat(l) * ((Math.sin(radIncli))/(Math.tan(altSol)) + Math.cos(radIncli))).toFixed(2);

}




//pasar los grados a Radianes
function gradosARadianes(x){
    return ((x * Math.PI)/parseFloat(180)).toFixed(3);

}
