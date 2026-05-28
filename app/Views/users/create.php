<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, Helvetica, sans-serif;
            background: radial-gradient(circle at 10% 20%, rgba(2, 18, 35, 1) 0%, rgba(5, 25, 55, 1) 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .card {
            width: 100%;
            max-width: 520px;
            background: rgba(12, 25, 45, 0.65);
            backdrop-filter: blur(18px);
            border: 1px solid rgba(72, 187, 255, 0.2);
            border-radius: 36px;
            padding: 38px 32px;
            box-shadow: 0 25px 45px -12px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(72, 187, 255, 0.1) inset;
        }

        .title {
            text-align: center;
            font-size: 34px;
            font-weight: 700;
            margin-bottom: 32px;
            background: linear-gradient(135deg, #E0F2FE, #7AA9FF);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            letter-spacing: -0.3px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-size: 14px;
            font-weight: 600;
            color: #B9E0FF;
            letter-spacing: 0.3px;
        }

        input[type="text"],
        input[type="email"],
        input[type="file"] {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid rgba(72, 187, 255, 0.25);
            outline: none;
            border-radius: 24px;
            background: rgba(2, 12, 27, 0.7);
            color: #F0F9FF;
            font-size: 15px;
            transition: all 0.2s ease;
            font-weight: 500;
        }

        input::placeholder {
            color: #7A9BCB;
            font-weight: 400;
        }

        input:focus {
            border-color: #3B82F6;
            background: rgba(10, 25, 47, 0.9);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.2);
        }

        input[type="file"] {
            padding: 12px 12px;
            background: rgba(2, 12, 27, 0.7);
            color: #B9E0FF;
        }

        .btn {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 40px;
            background: linear-gradient(105deg, #1E6DFF, #0057E2);
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 8px 20px -8px rgba(0, 87, 226, 0.4);
        }

        .btn:hover {
            transform: scale(1.01) translateY(-2px);
            background: linear-gradient(105deg, #3A7CFF, #1A66F0);
            box-shadow: 0 14px 28px -10px #1E6DFF;
        }

        .link {
            display: block;
            text-align: center;
            margin-top: 26px;
            color: #7AA9FF;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            transition: 0.2s;
        }

        .link:hover {
            color: #B2D6FF;
            text-decoration: none;
            letter-spacing: 0.2px;
        }

        .error {
            background: rgba(255, 70, 86, 0.15);
            border-left: 4px solid #FF5C6E;
            backdrop-filter: blur(4px);
            color: #FFC9CE;
            padding: 14px 18px;
            border-radius: 20px;
            margin-bottom: 18px;
            font-size: 14px;
            font-weight: 500;
        }
    </style>
</head>
<body>
<div class="card">
    <h1 class="title">Create User</h1>

    <?php if(session()->getFlashdata('errors')): ?>
        <?php foreach(session()->getFlashdata('errors') as $error): ?>
            <div class="error"><?= esc($error) ?></div>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if(session()->getFlashdata('error')): ?>
        <div class="error"><?= esc(session()->getFlashdata('error')) ?></div>
    <?php endif; ?>

    <form action="/users/store" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="name" value="<?= old('name') ?>" placeholder="e.g., Rimuru Tempest">
        </div>
        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" value="<?= old('email') ?>" placeholder="example@example.com">
        </div>
        <div class="form-group">
            <label>Profile Picture</label>
            <input type="file" name="avatar">
        </div>
        <button type="submit" class="btn">Save User</button>
    </form>
    <a href="/users" class="link">View All Users</a>
</div>
</body>
</html>