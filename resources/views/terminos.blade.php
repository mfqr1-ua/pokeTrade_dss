@extends('layouts.app')

@section('content')
<style>
    html, body {
        overflow-x: hidden;
    }
</style>
<div style="
    max-height: 80vh;
    overflow-y: auto;
    overflow-x: hidden;
    padding: 40px;
    max-width: 800px;
    margin: 40px auto;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
">
    <h1 class="text-center mb-4">Términos de Servicio</h1>

    <p><strong>1. Aceptación de los Términos</strong></p>
    <p>Bienvenido a PokeMarketTCG. Al acceder y utilizar nuestra plataforma, aceptas cumplir con los siguientes términos y condiciones. Si no estás de acuerdo con alguna parte de estos términos, no utilices nuestro servicio.</p>

    <p><strong>2. Descripción del Servicio</strong></p>
    <p>PokeMarketTCG es una plataforma en línea que permite a los usuarios comprar y vender cartas de Pokémon Trading Card Game (TCG). Ofrecemos herramientas para publicar cartas, gestionar transacciones y comunicarse entre usuarios.</p>

    <p><strong>3. Registro y Cuenta de Usuario</strong></p>
    <ul>
        <li>No compartir tus credenciales con terceros.</li>
        <li>Ser responsable de cualquier actividad realizada desde tu cuenta.</li>
        <li>Notificar de inmediato cualquier uso no autorizado de tu cuenta.</li>
    </ul>

    <p><strong>4. Compra y Venta de Cartas</strong></p>
    <ul>
        <li>Todos los listados deben describir con exactitud el estado y las características de la carta.</li>
        <li>El pago se procesa a través de los proveedores autorizados.</li>
        <li>No se permiten productos falsificados o que infrinjan derechos de autor.</li>
    </ul>

    <p><strong>5. Política de Pagos y Tarifas</strong></p>
    <p>Al usar PokeMarketTCG, aceptas las tarifas aplicables que se indican al momento de publicar o completar una transacción. Estas tarifas pueden incluir comisiones por venta, cargos por procesamiento de pago y otros costes operativos. Nos reservamos el derecho de cambiar estas tarifas en cualquier momento con previo aviso.</p>

    <p><strong>6. Envío y Entrega</strong></p>
    <p>Los vendedores son responsables de asegurar que las cartas se envíen en condiciones adecuadas, protegidas y dentro del plazo estipulado. Se recomienda usar servicios de envío con seguimiento. PokeMarketTCG no se hace responsable por pérdidas o daños durante el envío, pero podrá intervenir en caso de disputas.</p>

    <p><strong>7. Devoluciones y Reembolsos</strong></p>
    <p>Las devoluciones están sujetas a las políticas individuales del vendedor, las cuales deben estar claramente especificadas en cada publicación. En caso de que el producto recibido no coincida con la descripción, el comprador podrá solicitar un reembolso dentro de los 7 días posteriores a la entrega. PokeMarketTCG evaluará la situación y podrá mediar si es necesario.</p>

    <p><strong>8. Conducta del Usuario</strong></p>
    <ul>
        <li>Venta de productos falsificados o ilegales.</li>
        <li>Uso de lenguaje ofensivo o acosador.</li>
        <li>Intentos de fraude.</li>
    </ul>

    <p><strong>9. Suspensión y Terminación de Cuenta</strong></p>
    <p>PokeMarketTCG se reserva el derecho de suspender o eliminar cuentas que violen estos términos, sin previo aviso.</p>

    <p><strong>10. Modificaciones a los Términos</strong></p>
    <p>Nos reservamos el derecho de modificar estos términos en cualquier momento. Se notificará a los usuarios mediante correo electrónico o a través del sitio web.</p>

    <p><strong>11. Contacto</strong></p>
    <p>Para cualquier consulta, contáctanos a <a href="mailto:soporte@pokemarkettcg.com">soporte@pokemarkettcg.com</a>.</p>
</div>
@endsection