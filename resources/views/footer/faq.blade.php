@extends('layout.master')

@section('content')

  <main id="main">
    <div class="container py-5">
      <div class="row">
        <div class="col-12">
          <h1 class="text-left TituloFR my-4">Preguntas Frecuentes</h1>
        </div>
        <div class="col-12 text-justify mx-2">
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde dolor nisi suscipit possimus voluptates ea aspernatur voluptatum accusamus eveniet? Ipsa architecto reprehenderit et eveniet voluptas laboriosam numquam quia, sequi consectetur.</p>
        
          <div class="accordion mt-5" id="accordionExample">
            <div class="card">
              <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                  <button class="btn btn-block text-left collapsed btn-accordion-faq" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    <i class="fas fa-lock mr-1"></i> 
                    Seguridad
                  </button>
                </h2>
              </div>

              <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">

                  <a data-toggle="collapse" href="#collapse1" role="button" aria-expanded="false" aria-controls="collapse1" class="mb-3 text-dark"> 
                    <b>¿Hay política de devoluciones?</b> 
                  </a> <br>
                  <div class="collapse" id="collapse1">
                    <p class="ml-0 ml-md-4" >
                      Fashion Recovery cuenta con política de devoluciones, misma que podras verificar en la parte inferior central de nuestra página de inicio. 
                      Considera que solo se pueden devolver los productos comprados en Fashion Recovery en los siguientes casos:
                    </p>
                    <ul class="ml-0 ml-md-4">
                      <li>La prenda que compraste no te ha llegado.</li>
                      <li>La prenda que compraste se encuentra en mal estado (rota, rasgada, manchada).</li>
                      <li>La prenda que compraste no es de la talla que indica en la publicación de la web/app.</li>
                    </ul>
                    <p class="mb-4 ml-0 ml-md-4">
                      Si tu artículo cumple con alguno de los criterios anteriores, deberás seguir los pasos 
                      especificados en nuestra política de devoluciones dando click <a href="{{ url('/return-policy') }}" class="green-link">aquí</a>.
                    </p>
                  </div>
                  

                  <a data-toggle="collapse" href="#collapse2" role="button" aria-expanded="false" aria-controls="collapse2" class="mb-3 text-dark">
                    <b>¿Qué hago si otro usuario me molesta?</b>
                  </a> <br>
                  <div class="collapse" id="collapse2">
                    <p class="ml-0 ml-md-4">
                      Si detectas algún comentario ofensivo o una prenda que no cumple con los requisitos de 
                      la plataforma (por ej. es falso), puedes mandarnos un mail a 
                      <a href="mailto:contacto@fashionrecovery.com.mx" class="green-link">contacto@fashionrecovery.com.mx </a> 
                      enviando un pantallazo o el link del perfil del usuario o el producto.
                    </p>
                    <p class="mb-4 ml-0 ml-md-4">
                      O bien, si algún usuario te ha dejado comentarios inapropiados  puedes denunciar ese 
                      comentario y nuestro equipo de encargará de revisarlo y darle seguimiento.
                    </p>
                    </div>

                    <a data-toggle="collapse" href="#collapse8" role="button" aria-expanded="false" aria-controls="collapse8" class="mb-3 text-dark">
                      <b>¿Es seguro comprar?</b>
                    </a> <br>
                    <div class="collapse" id="collapse8">
                      <p class="ml-0 ml-md-4">
                        Tu seguridad es la mayor prioridad para nosotros. Nuestra plataforma es totalmente segura, no guardamos ni almacenamos los datos de pago como el número de la tarjeta de crédito/débito.
                      </p>
                      <p class="ml-0 ml-md-4">
                        La información de tu cuenta bancaria es totalmente privada. Los SERVICIOS de pago son operados mediante un proveedor externo que está obligado a salvaguardar toda la información bancaria proporcionada por los usuarios dentro del SITIO.
                        Gracias a los comentarios dejados en nuestra plataforma, te sentirás más seguro pues sabrás qué esperar del usuario que está comprando o vendiendo.
                      </p>
                      <p class="ml-0 ml-md-4">
                        Además, el dinero no se entregará al vendedor hasta <b>24 horas posteriores</b> a que el comprador haya recibido el artículo en cuestión y lo confirme como aceptado.
                        Si el estado del producto o la talla descrita en el catálogo no coincide con lo que recibes la devolución es gratis, por lo cual puedes tener plena confianza de comprar en Fashion Recovery pues no corres riesgo alguno.
                      </p>
                      <p class="mb-4 ml-0 ml-md-4">
                        Nuestro <b>FR Team</b> estará encantado de ayudarte si aún tienes dudas.
                      </p>
                    </div>
                    
                  

                  <a data-toggle="collapse" href="#collapse3" role="button" aria-expanded="false" aria-controls="collapse3" class="mb-3 text-dark">
                    <b>¿Es seguro vender?</b>
                  </a> <br>
                  <div class="collapse" id="collapse3">
                    <p class="ml-0 ml-md-4">
                      Tu seguridad es la mayor prioridad para nosotros. Nuestra plataforma es totalmente segura, no guardamos ni almacenamos los datos de pago como el número de la tarjeta de crédito/débito.
                    </p>
                    <p class="ml-0 ml-md-4">
                      La información de tu cuenta bancaria es totalmente privada: trabajamos con un procesador de pagos seguros para proteger tu cuenta bancaria y tu información personal.
                    </p>
                    <p class="ml-0 ml-md-4">
                      Gracias a los comentarios de la comprador que puedes ver en nuestra plataforma, te sentirás más seguro. 
                    </p>
                    <p class="ml-0 ml-md-4">
                      El importe de la venta de cada artículo publicado en el SITIO será abonado a una cuenta digital asociada tu perfil de usuario dentro del SITIO. Tú como vendedor, podrás solicitar que 
                      el dinero sea transferido hacia tu cuenta bancaria personal, en cualquier momento, despúes de que el comprador haya confirmado de recibido y de conformidad sobre el artículo en cuestión.
                    </p>
                    <p class="ml-0 ml-md-4">
                      No hay devoluciones si al comprado no le gusta o no le queda la prenda por lo que no incurriras en costos extras para vender tu producto.
                    </p>
                    <p class="ml-0 ml-md-4">
                      Solo te cobramos comisión sobre lo que hayas vendido, por lo que publicar toda la ropa que ya no te gusta o ya no te queda de tu closet es gratis.
                    </p>
                    <p class="ml-0 ml-md-4 mb-4">
                      Si aún así tienes dudas, nuestro  <b>FR Team</b> estará encantado de ayudarte, solo manda un mail a 
                      <a href="mailto:contacto@fashionrecovery.com.mx" class="green-link">contacto@fashionrecovery.com.mx </a> 
                      externando tu duda y nos contactaremos contigo. 
                    </p>
                  </div>

                  <a data-toggle="collapse" href="#collapse4" role="button" aria-expanded="false" aria-controls="collapse4" class="mb-3 text-dark">
                    <b>¿Están mis datos seguros?</b>
                  </a> <br>
                  <div class="collapse" id="collapse4">
                    <p class="ml-0 ml-md-4">
                      No te preocupes, tus datos personales están protegidos. Una de nuestras mayores prioridades es tu seguridad. Trabajamos con un proveedor de pagos seguro. Además no almacenamos los datos de tu tarjeta ni cuenta bancaria.
                    </p>
                    <p class="ml-0 ml-md-4">
                      Los demás datos como tu nombre <b>completo</b>, la dirección de envío o el teléfono de contacto se mostrará únicamente al vendedor para que pueda realizar el envío.
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                  <button class="btn btn-block text-left collapsed btn-accordion-faq" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <i class="fas fa-user mr-1"></i> 
                    Normas de la comunidad
                  </button>
                </h2>
              </div>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">

                  <a data-toggle="collapse" href="#collapse5" role="button" aria-expanded="false" aria-controls="collapse5" class="mb-3 text-dark">
                    <b>Usos inapropiados de Fashion Recovery</b>
                  </a> <br>
                  <div class="collapse" id="collapse5">
                    <p class="ml-0 ml-md-4">
                      Como de detalla en nuestros TÉRMINOS Y CONDICIONES; FASHION RECOVERY puede enviar avisos, 
                      suspender, bloquear o rescindir el acceso de un usuario al SITIO y/o a sus SERVICIOS, 
                      así como eliminar cualquier contenido, incluyendo cualquier artículo publicado para su 
                      venta, o iniciar las acciones que estime pertinentes y/o suspender las prestación de 
                      sus servicios siempre que:
                    </p>
                    <ul class="ml-0 ml-md-4">
                      <li>Se sospeche o se identifique el quebranto de alguna ley o cualquier incumplimiento de los TÉRMINOS Y CONDICIONES.</li>
                      <li>Se identifique un comportamiento que afecte negativamente la imagen de la marca.</li>
                      <li>Se incumplanlos compromisos como usuario, ya sea comprador o vendedor.</li>
                      <li>Se iincurra en conductas o actos dolosos o fraudulentos.</li>
                      <li>No sea posible verificar la identidad de un usuario o si cualquier información proporcionada por el mismo fuese errónea.</li>
                    </ul>
                    <p class="ml-0 ml-md-4 mb-4">
                      FASHION RECOVERY evaluará cada escenario de potencial incumplimiento para determinar si 
                      aplica una sanción, que puede ir desde una suspensión de usuaario temporal o definitiva; 
                      en cualquiera de los casos, todos los artículos que tuviera publicados serán removidos del 
                      sistema.
                    </p>
                  </div>

                  <a data-toggle="collapse" href="#collapse6" role="button" aria-expanded="false" aria-controls="collapse6" class="mb-3 text-dark">
                    <b>Normas de nuestra Comunidad</b>
                  </a> <br>
                  <div class="collapse" id="collapse6">
                    <p class="ml-0 ml-md-4">
                      Uno de los compromisos de FASHION RECOVERY ES es crear espacios para que nuestros vendedores 
                      y compradores (ustedes),  no solo sean usuarios, sino que se sientan parte de una comunidad 
                      que asume un compromiso con el medio ambiente, actuando siempre de una manera ética y 
                      responsable; por tal motivo contemplamos en nuestro día a día las siguinetes normas de 
                      convivencia que todos los usuarios debemos seguir, ya que en caso contrario es posible que 
                      existan sanciones o penalizaciones:
                    </p>
                    <p class="ml-0 ml-md-4">
                      <b>Amabilidad y respeto:</b> Mantén en todo momento una comunicación amable y cordial con otros 
                      usuarios de FASHION RECOVERY, ten en cuenta que pueden existir mas de una manera de pensar 
                      y de ver las cosas, por tal motivo, actua con respeto al interactuar en este espacio, sin 
                      incurrir en la utilización de malas palabras, palabras hirientes u otro tipo de insultos.
                    </p>
                    <p class="ml-0 ml-md-4">
                      <b>Uso del espacio para comentarios:</b> Evita poner tu teléfono, correo o red social en los 
                      comentarios de las publicaciones de artículos. Evita también la utilización de spam, 
                      es mejor que personalices cada comentario que hagas y no intentes mandar mensajes masivos 
                      y repetitivos para ejercer la autopromosión que suelen incomodar a los usuarios. 
                    </p>
                    <p class="ml-0 ml-md-4">
                      <b>Honestidad en el comercio:</b> Proporciona la descripción de tus productos con toda honestidad, 
                      si tienen algún detalle de uso menciónalo, revisa que la talla y marca que has descrito sea 
                      la correcta. Detalla lo mas posible la información del artículo, esto ayudará al comprador 
                      en la toma de decisiones para adquirir el producto, ya que como las prendas no se pueden 
                      probar, muchas veces los usuarios dudan al confirmar una compra si no hay mucho detalle 
                      sobre el artículo.
                    </p>
                    <p class="ml-0 ml-md-4">
                      <b> Lo que ves es lo que tendrás: </b>Para respetar a los compradores, los vendedores deberán presentar 
                      en las fotografías que suban a FASHION RECOVERY el producto que ofrecen, tal cual es. Si el artículo 
                      tiene algún defecto, alguna mancha, o algo parecido, no lo ocultes, muestralo; recuerda nuevamente 
                      que vale mas la honestidad en el comercio. Cuando realices el envio y si se trata de una prenda, 
                      enviala lavada y bien planchada.
                    </p>
                    <p class="ml-0 ml-md-4 mb-4">
                      <b>Comunicate con nosotros: </b>Si tienes una duda sobre una sobre como comprar o vender, sobre nuestras 
                      políticas y procedimientos, si deseas reportar algo, si has tenido algún problema con una usuaria 
                      o tienes un comentario o sugerencia, queremos saberlo. Por tal motivo, por favor comunicate con 
                      nosotros por... ?
                    </p>
                  </div>

                  <a data-toggle="collapse" href="#collapse7" role="button" aria-expanded="false" aria-controls="collapse7" class="mb-3 text-dark">
                    <b>¿Qué es SPAM y qué comentarios no están permitidos en la comunidad?</b>
                  </a> <br>
                  <div class="collapse" id="collapse7">
                    <p class="ml-md-4">
                      En FASHION RECOVERY nos preocupamos por mantener un ambiente de cordialidad y buena vibra entre las usuarias, 
                      por ello, algunos comentarios y malas prácticas no están permitidos... ?
                    </p>
                    <p class="ml-0 ml-md-4">
                      <b> Mensajes repetidos:</b> copiar y pegar el mismo mensaje una y otra vez en muros y productos es 
                      considerado SPAM. Algunas personas piensan que es molesto, recuerda que no a todos les gusta 
                      recibir mensajes promocionales o recibir comentarios sobre temas ajenos a sus compras y ventas.
                    </p>
                    <p class="ml-0 ml-md-4">
                      <b>Insultos y agresiones: </b>trata a las chicas de la comunidad como te gustaría ser tratada, sé amable 
                      y cordial. Si una persona te agrede no es necesario que respondas de la misma forma, puedes 
                      únicamente denunciar su comentario y será eliminado.
                    </p>
                    <p class="ml-0 ml-md-4">
                      <b>Uso inapropiado de la plataforma:</b> FASHION RECOVERY es una App para compra y venta de ropa, zapatos y 
                      accesorios, nuevos y de segunda mano, por lo que los intercambios o invitaciones a depositar montos por 
                      fuera no están permitidos. Realizar tu compra mediante la App te ofrece garantías que son válidas cuando 
                      sigues las reglas de la comunidad.
                    </p>
                    <p class="ml-0 ml-md-4">
                      <b>Datos personales:</b> ayúdanos a resguardar tus datos personales, no publiques números de teléfono, redes sociales, 
                      correos electrónicos, páginas web, ni ningún otro dato personal. Toda comunicación con las usurias podrás 
                      tenerla vía muro o dejando tus dudas en la publicación de tu interés.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
  </main>

@endsection