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
    <h1 class="text-center mb-4">Política de Privacidad</h1>

    <p><strong>1. Información General</strong></p>
    <p>PokeMarketTCG recopila, procesa y protege los datos personales de sus usuarios de conformidad con las normativas de protección de datos aplicables, incluyendo el Reglamento General de Protección de Datos (RGPD). El uso de nuestra plataforma implica la aceptación de esta política de privacidad.</p>

    <p><strong>2. Datos Recopilados</strong></p>
    <ul>
        <li><strong>Datos de registro:</strong> Nombre, dirección de correo electrónico y contraseña.</li>
        <li><strong>Datos de transacción:</strong> Información sobre compras, ventas y métodos de pago utilizados.</li>
        <li><strong>Datos técnicos:</strong> Dirección IP, tipo de navegador, sistema operativo y datos de acceso.</li>
        <li><strong>Cookies y tecnologías similares:</strong> Para mejorar la experiencia del usuario y analizar el rendimiento de la plataforma.</li>
    </ul>

    <p><strong>3. Uso de los Datos</strong></p>
    <ul>
        <li>Proporcionar y mejorar nuestros servicios.</li>
        <li>Gestionar transacciones y pagos de los usuarios.</li>
        <li>Garantizar la seguridad de la plataforma y prevenir fraudes.</li>
        <li>Cumplir con obligaciones legales y regulatorias.</li>
    </ul>

    <p><strong>4. Almacenamiento y Seguridad de los Datos</strong></p>
    <p>Los datos personales se almacenan de manera segura y solo durante el tiempo necesario para cumplir con los fines descritos en esta política. Implementamos medidas de seguridad técnicas y organizativas para proteger la información contra accesos no autorizados, pérdidas o alteraciones.</p>

    <p><strong>5. Compartición de Datos con Terceros</strong></p>
    <p>PokeMarketTCG no vende ni comparte datos personales con terceros, salvo en los siguientes casos:</p>
    <ul>
        <li>Con proveedores de servicios de pago (ej. PayPal, Stripe) para procesar transacciones.</li>
        <li>Con autoridades competentes en caso de requerimientos legales.</li>
    </ul>

    <p><strong>6. Derechos del Usuario</strong></p>
    <p>Los usuarios de PokeMarketTCG tienen los siguientes derechos:</p>
    <ul>
        <li><strong>Acceso:</strong> Consultar los datos personales almacenados.</li>
        <li><strong>Rectificación:</strong> Modificar información incorrecta o incompleta.</li>
        <li><strong>Supresión:</strong> Solicitar la eliminación de los datos personales.</li>
        <li><strong>Oposición:</strong> Negarse al procesamiento de los datos en ciertos casos.</li>
        <li><strong>Portabilidad:</strong> Solicitar una copia de los datos en un formato estructurado.</li>
    </ul>
    <p>Para ejercer estos derechos, puedes contactarnos en <a href="mailto:soporte@pokemarkettcg.com">soporte@pokemarkettcg.com</a>.</p>

    <p><strong>7. Uso de Cookies</strong></p>
    <p>Utilizamos cookies para mejorar la experiencia del usuario y analizar el uso de nuestra plataforma. Puedes configurar tu navegador para rechazar cookies, aunque esto podría afectar el funcionamiento de algunas características del sitio.</p>

    <p><strong>8. Modificaciones a la Política de Privacidad</strong></p>
    <p>Nos reservamos el derecho de modificar esta política en cualquier momento. Los cambios serán notificados en nuestra plataforma y entrarán en vigor desde su publicación.</p>

    <p><strong>9. Contacto</strong></p>
    <p>Si tienes preguntas sobre nuestra política de privacidad, puedes escribirnos a <a href="mailto:soporte@pokemarkettcg.com">soporte@pokemarkettcg.com</a>.</p>
</div>
@endsection
