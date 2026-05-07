{{-- Todo:
  2. Botão Copia/ Cola
  3. Botão Já realizei o pagamento
--}}
<div class="pix-info">
    <div>
        <ul>
            <li>O tempo para você pagar é de <strong>30 minutos</strong>. Não reservamos estoque até que o pagamento
                seja efetuado.</li>
            <li>Abra o aplicativo do seu banco ou instituição financeira e entre na área <strong>Pix</strong>.</li>
            <li>Escolha a opção <strong>Pagar com QR Code </strong> e aponte a câmera do ceu celular para a imagem</li>
            <li>Você também pode <strong>Pagar Pix Copia e Cola</strong> copiando o código dessa página</li>
            <li>Confirme as informações e <strong>Finalize o pagamento</strong></li>
            <li>Volte para nosso site e clique em <strong>Já realizei o pagamento</strong></li>
        </ul>
    </div>
    <div>
        <img src="{{ $order->orderPix->qrcode_image }}" alt="QR Code" title="QR Code">
        <textarea readonly id="pixQrCode">{{ $order->orderPix->qrcode }}</textarea>
        <p class="action-buttons">
            <button id="pixKeyButtton" class="button">
                <i class="fa fa-copy"></i> COPIAR CÒDIGO PIX
            </button>
            <button id="confirmPixPayment" class="button confirm">
                <i class="fa fa-check"></i> JÁ REALIZEI O PAGAMENTO
            </button>
        </p>
    </div>
</div>
