<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Recuperar Senha</h2>
                    
                    <form method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Informe seu e-mail</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Enviar Instruções</button>
                            <a href="<?= BASE_URL ?>login" class="btn btn-link">Voltar ao Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
