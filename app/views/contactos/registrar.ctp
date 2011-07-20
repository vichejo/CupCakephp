<article id="editorial">
    <header>
        <h2>Contacto</h2>
    </header>
    <div id="contacto">
        <form action="/contactos/registrar" method="post" id="form_test">
            <fieldset>
            <legend>Envie sus dudas y sugerencias</legend>

            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" title="Nombre" maxlength="60" placeholder="Nombre" autocomplete="off" required/>

            <label for="email">Correo Electrónico</label>
            <input type="email" name="email" id="email" title="Correo electrónico" maxlength="40" placeholder="Correo electrónico" autocomplete="off" required/>

            <label for="telefono">Teléfono (opcional)</label>
            <input type="tel" name="telefono" id="telefono" title="Teléfono" maxlength="20" placeholder="Teléfono" autocomplete="off"/>

            <label for="comentario">Comentario (max 100)</label>
            <textarea name="comentario" id="comentario" title="Comentario" cols="30" rows="5" maxlength="100" placeholder="Comentario..." required>
            </textarea>

            <input type="submit" value="Enviar" class="submit"/>

            </fieldset>
        </form>
    </div>
    <footer>
        <h3>About the author</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sodales urna non odio egestas tempor. Nunc vel vehicula ante. Etiam bibendum iaculis libero, eget molestie nisl pharetra in. In semper consequat est, eu porta velit mollis nec. Curabitur posuere enim eget turpis feugiat tempor.</p>
    </footer>

</article>



<?php echo $this->element('submenu_contacto',array('fecha'=>''));?>
<?php echo $this->element('menu');?>