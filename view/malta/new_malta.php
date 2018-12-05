<section class="container">
    <header><h2>Nueva Malta</h2></header>
    <article>
        <form>
            <div class="form-group">
                <label for="nombre_nueva_malta">Nombre</label>
                <input type="text" class="form-control" id="nombre_nueva_malta" name="nombre_nueva_malta">
            </div>
            <div class="form-group">
                <label for="tipo_nueva_malta">Tipo malta</label>
                <select id="tipo_nueva_malta" name="tipo_nueva_malta">
                    <option value="null">Selecciona tipo</option>
                    <option value="base">Base</option>
                    <option value="especial">Especial</option>
                </select>
            </div>
            <div class="form-group">
                <label for="ebc_nueva_malta">EBC</label>
                <input type="text" class="form-control" id="ebc_nueva_malta" name="ebc_nueva_malta">
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-default" onclick="saveMalta(this.form)">Guardar</button>
                <button type="button" class="btn btn-checkout" onclick="window.location.href='?c=malta'">Cancelar</button>
            </div>
        </form>
    </article>
</section>