<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Avalie sua experiencia</title>
</head>
<body style="margin:0;background:#f5f7fb;font-family:Arial,sans-serif;color:#111827;">
    <div style="max-width:640px;margin:0 auto;padding:32px 20px;">
        <div style="background:#111827;color:#ffffff;border-radius:24px;padding:32px;">
            <p style="margin:0 0 12px;font-size:12px;letter-spacing:.18em;text-transform:uppercase;color:#93c5fd;">Eventify Pulse</p>
            <h1 style="margin:0;font-size:30px;line-height:1.2;">Obrigado por participar de <?php echo e($event->title); ?></h1>
            <p style="margin:16px 0 0;font-size:16px;line-height:1.7;color:#d1d5db;">
                <?php echo e($feedback->recipient_name); ?>, queremos ouvir como foi sua experiencia no evento.
            </p>
        </div>

        <div style="background:#ffffff;border-radius:24px;padding:28px;margin-top:20px;border:1px solid #e5e7eb;">
            <p style="margin:0 0 12px;font-size:15px;line-height:1.7;color:#4b5563;">
                Sua resposta ajuda o organizador a entender o clima do evento, o que funcionou bem e o que pode ficar ainda melhor na proxima edicao.
            </p>
            <p style="margin:0 0 24px;font-size:15px;line-height:1.7;color:#4b5563;">
                Leva menos de 2 minutos.
            </p>

            <a href="<?php echo e($feedback->public_url); ?>" style="display:inline-block;background:#0f766e;color:#ffffff;text-decoration:none;padding:14px 22px;border-radius:999px;font-weight:700;">
                Avaliar evento
            </a>

            <div style="margin-top:24px;padding:16px;border-radius:18px;background:#f9fafb;color:#6b7280;font-size:13px;line-height:1.6;">
                Caso o botao nao abra, use este link:
                <br>
                <a href="<?php echo e($feedback->public_url); ?>" style="color:#0f766e;word-break:break-all;"><?php echo e($feedback->public_url); ?></a>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH /var/www/html/resources/views/emails/event-feedback-invitation.blade.php ENDPATH**/ ?>