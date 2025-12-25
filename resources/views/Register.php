<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 50px 60px;
            width: 100%;
            max-width: 600px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 40px 30px;
                max-width: 500px;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 30px 20px;
                max-width: 100%;
            }
        }

        .logo {
            text-align: center;
            margin-bottom: 15px;
            font-size: 48px;
        }

        h1 {
            color: #1a1a1a;
            font-size: 28px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 10px;
        }

        .subtitle {
            color: #666;
            font-size: 14px;
            text-align: center;
            margin-bottom: 35px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            color: #333;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 14px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #667eea;
            background: white;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 18px;
            display: none;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #999;
            cursor: pointer;
            font-size: 18px;
            display: none;
        }

        .error-message {
            color: #c53030;
            margin-top: 6px;
            font-size: 13px;
        }

        .success-message {
            background: #c6f6d5;
            color: #22543d;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .register-btn {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .register-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
        }

        .login-link {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
            color: #666;
        }

        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">🐾</div>
        <h1>Daftar Akun</h1>
        <p class="subtitle">Buat akun baru untuk melanjutkan</p>

        <?php if($errors->any()): ?>
            <div class="success-message" style="background: #fed7d7; color: #742a2a; margin-bottom: 20px;">
                <?php foreach($errors->all() as $error): ?>
                    <p><?php echo e($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="/register">
            <?php echo csrf_field(); ?>

            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <div class="input-wrapper">
                    <input type="text" id="name" name="name" placeholder="Nama Anda" required value="<?php echo e(old('name')); ?>">
                    <?php if($errors->has('name')): ?>
                        <div class="error-message"><?php echo e($errors->first('name')); ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-wrapper">
                    <input type="email" id="email" name="email" placeholder="email@contoh.com" required value="<?php echo e(old('email')); ?>">
                    <?php if($errors->has('email')): ?>
                        <div class="error-message"><?php echo e($errors->first('email')); ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrapper">
                    <input type="password" id="password" name="password" placeholder="Minimal 8 karakter" required>
                    <?php if($errors->has('password')): ?>
                        <div class="error-message"><?php echo e($errors->first('password')); ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <div class="input-wrapper">
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi password" required>
                </div>
            </div>

            <button type="submit" class="register-btn">Daftar</button>
        </form>

        <div class="login-link">
            Sudah punya akun? <a href="/login">Masuk di sini</a>
        </div>
    </div>
</body>
</html>
