( función ( global , fábrica ) {
  typeof  exports  ===  ' object '  &&  typeof  module  ! ==  ' undefined '  ?  módulo . exports  =  factory () :
  typeof define ===  ' function '  &&  define . amd  ?  definir (fábrica) :
  ( global . Popper  =  fábrica ());
} ( this , ( function () { ' use strict ' ;

  Objeto . asignar || Objeto . defineProperty ( Objeto , ' Asignar ' , {enumerables : ! 1 , configurable : ! 0 , se puede escribir : ! 0 , valor : la función de  valor ( un ) { si (una === vacío  0 || nula === a) arrojar  nueva  TypeError ( ' No se puede convertir el primer argumento al objeto ' );var b = Objeto (a); for ( var c = 1 ; c < argumentos . length ; c ++ ) { var d = argumentos [c]; if ( void  0 ! == d && null ! == d) {d = Objeto (d); var e = Objeto . llaves (d); for ( var f = 0 , g = e .longitud ; f < g; f ++ ) { var h = e [f], j = Objeto . getOwnPropertyDescriptor (d, h); void  0 ! == j && j . enumerable && (b [h] = d [h]);}}} return b}});

  if ( ! window . requestAnimationFrame ) { var lastTime = 0 , proveedores = [ ' ms ' , ' moz ' , ' webkit ' , ' o ' ]; para ( var x = 0 ; x < proveedores . longitud &&! ventana . requestAnimationFrame ; ++ x) ventana . requestAnimationFrame =ventana [proveedores [x] + ' RequestAnimationFrame ' ], ventana . cancelAnimationFrame = window [proveedores [x] + ' CancelAnimationFrame ' ] || ventana [proveedores [x] + ' CancelRequestAnimationFrame ' ]; ventana . requestAnimationFrame || ( ventana . requestAnimationFrame = function ( a ) { var b = new  Fecha (). getTime(), c = Matemáticas . max ( 0 , 16 - (b - lastTime)), d = ventana . setTimeout ( function () { a (b + c);}, c); return lastTime = b + c, d}), ventana . cancelAnimationFrame || ( ventana . cancelAnimationFrame = function ( a ) { clearTimeout (a);});}

  función  findIndex ( a , b , c ) { var d = a . filtro ( función ( e ) { retorno e [b] === c}) [ 0 ]; devolver  a . indexOf (d)}

  función  getOffsetParent ( a ) { var b = a . offsetParent ; devuelve b && ' BODY ' ! == b . nodeName ? b : ventana . documento . documentElement }

  function  getStyleComputedProperty ( a , b ) { if ( 1 ! == a . nodeType ) return []; var c = ventana . getComputedStyle (a, null ); devolver c [b]}

  función  getParentNode ( a ) { return  a . parentNode || a . anfitrión }

  function  getScrollParent ( a ) { return a === ventana . documento ? ventana . documento . cuerpo . scrollTop ? ventana . documento . cuerpo : ventana . documento . documentElement : - 1 ! == [ ' scroll ' , ' auto ' ]. indexOf ( getStyleComputedProperty (a, ' overflow' )) || - 1 ! == [ ' scroll ' , ' auto ' ]. indexOf ( getStyleComputedProperty (a, ' overflow-x ' )) || - 1 ! == [ ' scroll ' , ' auto ' ]. indexOf ( getStyleComputedProperty (a, ' overflow-y ' )) ? una === ventana . documento . cuerpo? getScrollParent ( getParentNode (a)) : a : getParentNode (a) ? getScrollParent ( getParentNode (a)) : a}

  function  getOffsetRect ( a ) { var b = ventana . documento . documentElement , c = void  0 ; devolver c = a === b ? {ancho : Matemáticas . max ( b . clientWidth , window . innerWidth || 0 ), height : Math . max ( b . cliente Altura , ventana .innerHeight || 0 ), izquierda : 0 , arriba : 0 } : {ancho : a . offsetWidth , height : a . offsetHeight , izquierda : a . offsetLeft , arriba : a . offsetTop }, c . derecha = c . izquierda + c . ancho , c . abajo = c . arriba + c .altura , c}

  function  isFixed ( a ) { return a ! == ventana . documento . cuerpo && ( ! ( ' fixed ' ! == getStyleComputedProperty (a, ' position ' )) || ( getParentNode (a) ? isFixed ( getParentNode (a)) : a))}

  function  getPosition ( a ) { var b = getOffsetParent (a), c = isFixed (b); devolver c ? ' fijo ' : ' absoluto ' }

  función  getBoundingClientRect ( a ) { var b = a . getBoundingClientRect (); return {izquierda : b . izquierda , arriba : b . arriba , a la derecha : b . derecha , abajo : b . abajo , ancho : b . derecha - b . izquierda , altura : b . abajo - b . arriba }}

  function  getOffsetRectRelativeToCustomParent ( a , b ) { var c = 2 < argumentos . length && void  0 ! == argumentos [ 2 ] && argumentos [ 2 ], d = 3 < argumentos . length && void  0 ! == arguments [ 3 ] && arguments [ 3 ], e = getBoundingClientRect (a), f =getBoundingClientRect (b); if (c &&! d) { var j = getScrollParent (b); f . arriba + = j . scrollTop , f . abajo + = j . scrollTop , f . izquierda + = j . scrollLeft , f . derecha + = j . scrollLeft ;} var g = {top : e . arriba - f. arriba , izquierda : e . izquierda - f . izquierda , abajo : e . arriba - f . arriba + e . altura , derecha : e . izquierda - f . izquierda + e . ancho , ancho : e . ancho , alto : e . altura }, h = b . scrollTop , i = b .scrollLeft ; devolver  g . arriba + = h, g . abajo + = h, g . izquierda + = i, g . derecha + = i, g}

  function  getBoundaries ( a , b , c ) { var d = {}, e = getOffsetParent (a), f = getScrollParent (a); if ( ' ventana ' === c) { var g = ventana . documento . cuerpo , h = ventana . documento . documentElement , i = Math . max ( g . scrollHeight ,g . offsetAltura , h . clienteAltura , h . scrollHeight , h . offsetHeight ), j = Math . max ( g . scrollWidth , g . offsetWidth , h . clientWidth , h . scrollWidth , h . offsetWidth ); d = {top : 0 , a la derecha : j, parte inferior : i, Izquierda : 0};} else  if ( ' viewport ' === c) { var _g = getOffsetRect (e), _ h = getPosition (a); d = ' fixed ' === _h ? {arriba : 0 , derecha : ventana . documento . documentElement . clientWidth , bottom : ventana . documento . documentElement . clienteAltura , izquierda : 0 } :{arriba : 0 - _g . arriba , a la derecha : ventana . documento . documentElement . clientWidth - _g . izquierda , abajo : ventana . documento . documentElement . clienteHeight - _g . arriba , izquierda : 0 - _g . left };} else d = f === c || ' scrollParent ' ===c ? getOffsetRectRelativeToCustomParent (f, e) : getOffsetRectRelativeToCustomParent (c, e); if ( e . contiene (f)) { var _g2 = f . scrollLeft , _h2 = f . scrollTop ; d . derecha + = _g2, d . bottom + = _h2;} return  d . left + = b, d . arriba + = b, d . derecha - =b, d . abajo - = b, d}

  function  getOuterSizes ( a ) { var b = a . estilo . pantalla , c = a . estilo . visibilidad ; a . estilo . display = ' bloque ' , a . estilo . visibility = ' oculto ' ; var d = ventana . getComputedStyle (a), e = parseFloat ( d .marginTop ) + parseFloat ( d . marginBottom ), f = parseFloat ( d . marginLeft ) + parseFloat ( d . marginRight ), g = {ancho : a . offsetWidth + f, altura : a . offsetHeight + e}; devolver  a . estilo . display = b, a . estilo . visibilidad =c, g}

  function  getPopperClientRect ( a ) { return  Object . assign ({}, a, {right : a . left + a . width , bottom : a . top + a . height })}

  function  getSupportedPropertyName ( a ) { var b = [ ' ' , ' ms ' , ' webkit ' , ' moz ' , ' o ' ]; for ( var c = 0 ; c < b . length ; c ++ ) { var d = b [c] ? b [c] + a . charAt ( 0 ).toUpperCase () + a . rebanada ( 1 ) : a; if ( ' undefined ' ! = typeof  window . document . body . style [d]) return d} return  null }

  function  isFunction ( a ) { return a && ' [object Function] ' === {}. toString . llamar (a)}

  función  isModifierRequired ( a , b , c ) { return !! a . filter ( function ( d ) { if ( d . name === c) return ! 0 ; return  d . name ! == b &&! 1 }). longitud }

  function  isNumeric ( a ) { return ' ' ! == a &&! isNaN ( parseFloat (a)) && isFinite (a)}

  la función  isTransformed ( a ) { return a ! == window . documento . cuerpo && ( ' ninguno ' ! == getStyleComputedProperty (a, ' transform ' ) || ( getParentNode (a) ? isTransformed ( getParentNode (a)) : a))}

  function  runModifiers ( a , b , c ) { var d = void  0 === c ? a : a . slice ( 0 , findIndex (a, ' nombre ' , c)); regreso  d . forEach ( función ( e ) { e . activar && isFunction ( e . función ) && (b = e. función (b, e));}), b}

  function  setStyle ( a , b ) { Object . teclas (b). forEach ( function ( c ) { var d = ' ' ; - 1 ! == [ ' width ' , ' height ' , ' top ' , ' right ' , ' bottom ' , ' left ' ]. indexOf (c) && isNumeric(b [c]) && (d = ' px ' ), a . estilo [c] = b [c] + d;});}

  var Utilidades = {FindIndex : FindIndex, getBoundaries : getBoundaries, getBoundingClientRect : getBoundingClientRect, getOffsetParent : getOffsetParent, getOffsetRectRelativeToCustomParent : getOffsetRectRelativeToCustomParent, getOuterSizes : getOuterSizes, getPopperClientRect : getPopperClientRect, getPosition : getPosition, getScrollParent : getScrollParent, getStyleComputedProperty : getStyleComputedProperty, getSupportedPropertyName : getSupportedPropertyName, IsFixed : isFixed, isFunction :isFunction, isModifierRequired : isModifierRequired, isNumeric : isNumeric, isTransformed : isTransformed, runModifiers : runModifiers, setStyle : setStyle};

  var nativeHints = [ ' código nativo ' , ' [objeto MutationObserverConstructor] ' ]; var isNative = ( function ( a ) { return  nativeHints . some ( function ( b ) { return - 1 < (a || ' ' ). toString (). indexOf (b)})});

  var longerTimeoutBrowsers = [ ' Edge ' , ' Trident ' , ' Firefox ' ]; var timeoutDuration = 0 ; for ( var a = 0 ; a < longerTimeoutBrowsers . length ; a + = 1 ) if ( 0 <= navegador . userAgent . indexOf (longerTimeoutBrowsers [a])) {timeoutDuration = 1 ; descanso} function microtaskDebounce (a) {var b =! 1, c = 0, d = document.createElement ('span'), e = nuevo MutationObserver (function () {a (), b =! 1;}); return e.observe (d, {childList:! 0}), function () {b || (b =! 0, d.textContent = '' + c, c + = 1);}} función taskDebounce (a) {var b =! 1; return function () {b || (b =! 0, setTimeout (function () {b =! 1, a ();}, timeoutDuration));}} var supportsNativeMutationObserver = isNative (window.MutationObserver ); var debounce = supportsNativeMutationObserver? microtaskDebounce: taskDebounce;

  función  getOffsets ( a , b , c , d ) {d = d . división ( ' - ' ) [ 0 ]; var e = {}; e . posición = a . posición ; var f = ' fijo ' === e . posición , g = a . isParentTransformed , h = getOffsetParent (f &&g ? c : b), i = getOffsetRectRelativeToCustomParent (c, h, f, g), j = getOuterSizes (b); return - 1 === [ ' derecha ' , ' izquierda ' ]. indexOf (d) ? ( E . Izquierda = i . Izquierda + i . Anchura / 2 - j . Anchura / 2 , e . Superiores = ' top' === d ? yo . arriba - j . altura : i . parte inferior ) : ( e . top = i . top + i . altura / 2 - j . altura / 2 , e . izquierda = ' izquierda ' === d ? i . izquierda - j . anchura : i .derecha ), e . ancho = j . ancho , e . altura = j . altura , {popper : e, referencia : i}}

  función  setupEventListeners ( un , b , c , d ) { si ( c . updateBound = d, ventana . addEventListener ( ' cambiar el tamaño ' , c . updateBound , {pasiva : ! 0 }), ' ventana ' ! == b . boundariesElement ) { var e = getScrollParent (a); (e === ventana . documento. cuerpo || e === ventana . documento . documentElement ) && (e = window ), e . addEventListener ( ' scroll ' , c . updateBound , {pasiva : ! 0 }), c . scrollElement = e;}}

  function  removeEventListeners ( a , b ) { ventana de retorno  . removeEventListener ( ' redimensionar ' , b . updateBound ), b . scrollElement && b . scrollElement . removeEventListener ( ' scroll ' , b . updateBound ), b . updateBound = null , b . scrollElement = null , b}

  función  sortModifiers ( c , d ) { si ( c . fin < d . orden ) de retorno - 1 ; volver  c . orden > d . orden ? 1 : 0 }

  function  applyStyle ( a ) { var b = {position : a . compensaciones . Popper . posición }, c = Matemáticas . round ( a . offsets . popper . left ), d = Math . round ( a . offsets . popper . top ), e = getSupportedPropertyName ( ' transform ' ); regreso a . instancia . opciones . gpuAcceleration && e ? (b [e] = ' translate3d ( ' + c + ' px, ' + d + ' px, 0) ' , b . arriba = 0 , b . left = 0 ) : ( b . left = c, b . top = d), Object . asignar (b,a . estilos ), setStyle ( a . instancia . popper , b), a . instancia . Popper . setAttribute ( ' x-placement ' , a . placement ), a . compensaciones . flecha && setStyle ( un . arrowElement , un . compensaciones . flecha ), a} función applyStyleOnLoad (a, b, c) {return b.setAttribute ( 'x-colocación', c.placement), c}

  función  flecha ( a , b ) { var c = b . elemento ; si ( ' cadena ' == typeof c && (c = un . ejemplo . popper . querySelector (c)), ! c) volver a; if ( ! a . instancia . popper . contiene (c)) devuelve la  consola . advertir (' ADVERTENCIA: `arrowElement` debe ser hijo de su elemento popper. ' ), a; if ( ! isModifierRequired ( a . instance . modificadores , ' arrow ' , ' keepTogether ' )) devuelve la  consola . warn ( ' ADVERTENCIA: el modificador de flecha requiere el modificador keepTogether para funcionar, ¡asegúrate de incluirlo antes de la flecha! ' ), a; var d = {}, e = a . colocación . división( ' - ' ) [ 0 ], f = getPopperClientRect ( un . Compensaciones . Popper ), g = una . compensaciones . referencia , h = - 1 ! == [ ' izquierda ' , ' derecha ' ]. indexOf (e), i = h ? ' altura ' : ' ancho ' , j = h ? ' top ': ' izquierda ' , k = h ? ' izquierda ' : ' arriba ' , l = h ? ' abajo ' : ' derecha ' , m = getOuterSizes (c) [i]; g [l] - m < f [j] && ( a . offsets . popper [j] - = f [j] - (g [l ] - m)), g [j] + m > f [l] && ( a. compensaciones . popper [j] + = g [j] + m - f [l]); var n = g [j] + g [i] / 2 - m / 2 , o = n - getPopperClientRect ( a . offsets . popper ) [j]; return o = Matemáticas . max ( Math . min (f [i] - m, o), 0 ), d [j] = o, d [k] = '' , a . compensaciones . flecha = d, a . arrowElement = c, a}

  function  getOppositePlacement ( a ) { var b = {left : ' derecha ' , derecha : ' izquierda ' , abajo : ' top ' , arriba : ' bottom ' }; devolver  a . replace ( / left | right | bottom | top / g , función ( c ) { return b [c]})}

  function  getOppositeVariation ( a ) { if ( ' end ' === a) return ' start ' ; return ' start ' === a ? ' final ' : a}

  función flip (a, b) {if (a.flipped && a.placement === a.originalPlacement) return a; var c = getBoundaries (a.instance.popper, b.padding, b.boundariesElement), d = a.placement .split ('-') [0], e = getOppositePlacement (d), f = a.placement.split ('-') [1] || '', g = []; return g = 'flip' = == b.behavior? [d, e]: b.behavior, g.forEach (function (h, i) {if (d! == h || g.length === i + 1) return a; d = a.placement.split ('-') [0], e = getOppositePlacement (d); var j = getPopperClientRect (a.offsets.popper), k = 'left' === d && Math.floor (j.left) <Math.floor (c.left) || 'right' === d && Math.floor (j.right)> Math.floor (c.right) || 'top' === d && Math.floor (j.top) <Math.floor (c.top) || 'bottom' === d && Math.floor (j.bottom)> Math.floor (c.bottom), l = -1! == ['top', 'bottom' ] .indexOf (d), m = !! b.flipVariations &&(l && 'start' === f && Math.floor (j.left) <Math.floor (c.left) || l && 'end' === f && Math.floor (j.right)> Math.floor (c.right) ) ||! l && 'start' === f && Math.floor (j.top) <Math.floor (c.top) ||! l && 'end' === f && Math.floor (j.bottom)> Math.floor (c.bottom)); (k || m) && (a.flipped =! 0, k && (d = g [i + 1]), m && (f = getOppositeVariation (f)), a.placement = d + ( f? '-' + f: ''), a.offsets.popper = getOffsets (a.instance.state, a.instance.popper, a.instance.reference, a.placement) .popper, a = runModifiers (a .instance.modifiers, a, 'flip'));}), a}floor (c.top) ||! l && 'end' === f && Math.floor (j.bottom)> Math.floor (c.bottom)); (k || m) && (a.flipped =! 0, k && (d = g [i + 1]), m && (f = getOppositeVariation (f)), a.placement = d + (f? '-' + f: ''), a.offsets.popper = getOffsets (a. instance.state, a.instance.popper, a.instance.reference, a.placement) .popper, a = runModifiers (a.instance.modifiers, a, 'flip'));}), a}floor (c.top) ||! l && 'end' === f && Math.floor (j.bottom)> Math.floor (c.bottom)); (k || m) && (a.flipped =! 0, k && (d = g [i + 1]), m && (f = getOppositeVariation (f)), a.placement = d + (f? '-' + f: ''), a.offsets.popper = getOffsets (a. instance.state, a.instance.popper, a.instance.reference, a.placement) .popper, a = runModifiers (a.instance.modifiers, a, 'flip'));}), a}

  función  keepTogether ( a ) { var b = getPopperClientRect ( a . offsets . popper ), c = a . compensaciones . referencia , d = Matemáticas . piso , e = a . colocación . división ( ' - ' ) [ 0 ]; return - 1 === [ ' top ' , ' bottom ']] indexOf (e) ? ( B . Fondo < d ( c . Superior ) && ( un . Compensaciones . Popper . Top = d ( c . Superior ) - b . Altura ), b . Top > d ( c . Inferior ) && ( un . Compensaciones . Popper . top = d( C . Inferior ))) : ( b . Derecho < d ( c . Izquierda ) && ( un . Compensaciones . Popper . Izquierda = d ( c . Izquierda ) - b . Ancho ), b . Izquierda > d ( c . Derecha ) && ( a . offsets . popper . left= d ( c . derecha ))), a}

   desplazamiento de función ( a , b ) { var c = a . colocación , d = a . compensaciones . popper , e = vacío  0 ; return  isNumeric ( b . offset ) ? e = [ b . offset , 0 ] : (e = b . offset . split ( '  ' ), e = e. map ( función ( f , g ) { var h = f . match ( / ( \ d * \. ? \ d * ) ( . * ) / ), i = + h [ 1 ], j = h [ 2 ], k = - 1 ! == c . indexOf ( ' derecha ' ) || - 1 ! == c .indexOf ( ' izquierda ' ); si ( 1 === g && (k = ! k), ' % ' === j || ' % r ' === j) { var l = getPopperClientRect ( un . compensaciones . referencia ), m = void  0 ; devolver m = k ? l . altura : l . ancho , m/ 100 * i} Si ( ' % p ' === j) { var _L = getPopperClientRect ( un . Compensaciones . Popper ), _ m = void  0 ; devolver _m = k ? _l . altura : _l . width , _m / 100 * i} if ( ' vh ' === j || ' vw ' ===j) { var _l2 = vacío  0 ; return _l2 = ' vh ' === j ? Matemáticas . max ( documento . documentElement . clientHeight , ventana . innerHeight || 0 ) : Matemáticas . max ( document . documentElement . clientWidth , window . innerWidth || 0 ), _ l2 / 100 *i} devuelve ' px ' === j ? + i : + f})), - 1 === a . colocación . indexOf ( ' izquierda ' ) ? - 1 === a . colocación . indexOf ( ' derecha ' ) ? - 1 === a . colocación . indexOf ( ' top ' ) ? -1 ! == a . colocación . indexOf ( ' bottom ' ) && ( d . left + = e [ 0 ], d . top + = e [ 1 ] || 0 ) : ( d . left + = e [ 0 ], d . top - = e [ 1 ] || 0 ) : ( d . Top + = e [ 0], d . left + = e [ 1 ] || 0 ) : ( d . Arriba + = e [ 0 ], d . Izquierda - = e [ 1 ] || 0 ), a}

  función preventOverflow (c, d) {var e = d.boundariesElement || getOffsetParent (c.instance.popper), f = getBoundaries (c.instance.popper, d.padding, e); d.boundaries = f; var g = d.priority, h = getPopperClientRect (c.offsets.popper), i = {left: function left () {var j = h.left; return h.left <f.left &&! shouldOverflowBoundary (c, d, 'left ') && (j = Math.max (h.left, f.left)), {left: j}}, right: function right () {var j = h.left; return h.right> f.right &&! shouldOverflowBoundary (c, d, 'right') && (j = Math.min (h.left, f.right-h.width)), {left: j}}, top: function top () {var j = h .top; return h.top <f.top &&! shouldOverflowBoundary (c, d, 'top') && (j = Math.max (h.top, f.top)), {top: j}}, bottom: function bottom () {var j = h.top; return h.bottom> f.bottom &&! shouldOverflowBoundary (c, d, 'bottom') && (j = Math.min (h.top, f.bottom-h.height)), {top: j}}}; return g.forEach (function (j) {c.offsets.popper = Object.assign (h, i [j] ());}), c} function shouldOverflowBoundary ( c, d, e) {return !! d.escapeWithReference && (c.flipped && isSameAxis (c.originalPlacement, e) || !! isSameAxis (c.originalPlacement, e) ||! 0)} function isSameAxis (c, d) { var e = c.split ('-') [0], f = d.split ('-') [0]; return e === f || e === getOppositePlacement (d)}

  función  shift ( a ) { var b = a . colocación , c = b . división ( ' - ' ) [ 0 ], d = b . división ( ' - ' ) [ 1 ]; if (d) { var e = a . compensaciones . referencia , f = getPopperClientRect ( a . offsets . popper ), g ={y : {start : {top : e . arriba }, fin : {arriba : e . arriba + e . altura - f . height }}, x : {start : {left : e . left }, end : {left : e . izquierda + e . ancho - f . width }}}, h = - 1 === [ ' bottom' , ' arriba ' ]. indexOf (c) ? ' y ' : ' x ' ; a . compensaciones . popper = Objeto . assign (f, g [h] [d]);} return a}

  función  hide ( a ) { if ( ! isModifierRequired ( a . instance . modificadores , ' hide ' , ' preventOverflow ' )) return  console . warn ( ' ADVERTENCIA: el modificador hide requiere el modificador preventOverflow para funcionar, ¡asegúrate de incluirlo antes de ocultar! ' ), a; var b = a . compensaciones . referencia , c = a .instancia . modificadores . filter ( función ( d ) { return ' preventOverflow ' === d . name }) [ 0 ]. límites ; if ( b . bottom < c . top || b . left > c . right || b . top > c . bottom || b . right < c. left ) { if ( ! 0 === a . hide ) return a; a . hide = ! 0 , a . instancia . Popper . setAttribute ( ' x-out-of-boundaries ' , ' ' );} else { if ( ! 1 === a . hide ) return a; a . hide = ! 1, a . instancia . Popper . removeAttribute ( ' x-out-of-boundaries ' );} return a}

  var modifiersFunctions = {applyStyle : applyStyle, arrow : arrow, flip : flip, keepTogether : keepTogether, offset : offset, preventOverflow : preventOverflow, shift : shift, hide : hide}; var modifiersOnLoad = {applyStyleOnLoad : applyStyleOnLoad};

  var  classCallCheck  =  function ( instancia , Constructor ) {
    if ( ! (instance instanceof Constructor)) {
      lanzar  nuevo  TypeError ( " No se puede llamar a una clase como una función " );
    }
  };

  var  createClass  =  function () {
    function  defineProperties ( target , props ) {
      for ( var i =  0 ; i <  props . length ; i ++ ) {
        var descriptor = props [i];
        descriptor . enumerable  =  descriptor . enumerable  ||  falsa ;
        descriptor . configurable  =  verdadero ;
        si ( " valor "  en el descriptor) descriptor . escribible  =  verdadero ;
        Objeto . defineProperty (destino, descriptor . clave , descriptor);
      }
    }

     función de retorno ( Constructor , protoProps , staticProps ) {
      si (protoProps) defineProperties ( Constructor . prototipo , protoProps);
      if (staticProps) defineProperties (Constructor, staticProps);
      devolver Constructor;
    };
  } ();







  var  get  =  function  get ( objeto , propiedad , receptor ) {
    if (object ===  null ) object =  Función . prototipo ;
    var desc =  Object . getOwnPropertyDescriptor (objeto, propiedad);

    if (desc ===  undefined ) {
      var parent =  Object . getPrototypeOf (object);

      if (parent ===  null ) {
        regreso  indefinido ;
      } else {
        return  get (padre, propiedad, receptor);
      }
    } else  if ( " valor "  en desc) {
      regreso  desc . valor ;
    } else {
      var getter =  desc . obtener ;

      if (getter ===  undefined ) {
        regreso  indefinido ;
      }

      volver  getter . llamada (receptor);
    }
  };

















  var  conjunto  =  función  set ( objeto , propiedad , valor , receptor ) {
    var desc =  Object . getOwnPropertyDescriptor (objeto, propiedad);

    if (desc ===  undefined ) {
      var parent =  Object . getPrototypeOf (object);

      if (parent ! ==  null ) {
        set (padre, propiedad, valor, receptor);
      }
    } else  if ( " valor "  en desc &&  desc . escribible ) {
      desc . valor  = valor;
    } else {
      var setter =  desc . establecer ;

      if (setter ! ==  undefined ) {
        setter . llamada (receptor, valor);
      }
    }

    valor de retorno ;
  };

  var DEFAULTS = {placement: 'bottom', gpuAcceleration:! 0, modificadores: {shift: {orden: 100, habilitado:! 0, función: modifiersFunctions.shift}, desplazamiento: {orden: 200, habilitado:! 0, función : modifiersFunctions.offset, offset: 0}, preventOverflow: {order: 300, enabled:! 0, function: modifiersFunctions.preventOverflow, priority: ['left', 'right', 'top', 'bottom'], relleno: 5, boundariesElement: 'scrollParent'}, keepTogether: {order: 400, enabled:! 0, function: modifiersFunctions.keepTogether}, arrow: {order: 500, enabled:! 0, function: modifiersFunctions.arrow, element: '[ x-arrow] '}, flip: {order: 600, enabled:! 0, function: modifiersFunctions.flip, behavior:' flip ', relleno: 5, boundariesElement:' viewport '}, hide: {order: 700, enabled :! 0, function: modifiersFunctions.hide}, applyStyle: {order: 800, enabled:! 0, function: modifiersFunctions.applyStyle, onLoad:modifiersOnLoad.applyStyleOnLoad}}}; var Popper = function () {función Popper (a, b) {var _this = this, c = 2 <arguments.length && void 0! == argumentos [2]? argumentos [2]: {} ; return classCallCheck (this, Popper), this.Defaults = DEFAULTS, this.update = rebote (this.update.bind (this)), this.scheduleUpdate = function () {return requestAnimationFrame (_this.update)}, esto. state = {isDestroyed:! 1, isCreated:! 1}, this.reference = a.jquery? a [0]: a, this.popper = b.jquery? b [0]: b, this.options = Object. assign ({}, DEFAULTS, c), this.modifiers = Object.keys (DEFAULTS.modifiers) .map (function (d) {return Object.assign ({name: d}, DEFAULTS.modifiers [d])}) , this.modifiers = this.modifiers.map (function (d) {var e = c.modifiers && c.modifiers [d.name] || {}, f = Object.assign ({}, d, e); return f }), c.modifiers && (this.options.modifiers = Object.assign ({}, DEFAULTS.modifiers, c.modifiers), Object.keys (c.modifiers).forEach (function (d) {if (void 0 === DEFAULTS.modifiers [d]) {var e = c.modifiers [d]; e.name = d, _this.modifiers.push (e);}}) ), this.modifiers = this.modifiers.sort (sortModifiers), this.modifiers.forEach (function (d) {d.enabled && isFunction (d.onLoad) && d.onLoad (_this.reference, _this.popper, _this.options, d);}), this.state.position = getPosition (this.reference), this.state.isParentTransformed = isTransformed (this.popper.parentNode), this.update (), setupEventListeners (this.reference, this.options, this.state, this.scheduleUpdate), this} return createClass (Popper, [{key: 'update', value: function update () {var a = {instancia: this, styles: {}, flipped:! 1}; this.state.position = getPosition (this.reference), setStyle (this.popper, {position: this.state.position}), this.state.isDestroyed || (a.placement = this.options.placement, a. originalPlacement = this.options.placement, a.offsets = getOffsets (this.state, this.popper, this.reference, a.placement), a = runModifiers (this.modifiers, a), this.state.isCreated? isFunction (this.state.updateCallback) && this.state. updateCallback (a) :( this.state.isCreated =! 0, isFunction (this.state.createCallback) && this.state.createCallback (a)));}}, {key: 'onCreate', value: function onCreate (a ) {return this.state.createCallback = a, this}}, {key: 'onUpdate', value: function onUpdate (a) {return this.state.updateCallback = a, this}}, {key: 'destroy', value: function destroy () {return this.state.isDestroyed =! 0, this.popper.removeAttribute ('x-placement'), this.popper.style.left = '', this.popper.style.position = ' ', this.popper.style.top =' ', this.popper.style [getSupportedPropertyName (' transform ')] =' ', this.state = removeEventListeners (this.reference, this.state), this.options.removeOnDestroy && this.popper.parentNode.removeChild (this.popper), this}}]), Popper} (); Popper.Utils = Utils;

  devuelve Popper;

})));
