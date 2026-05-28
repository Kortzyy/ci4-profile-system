<?php
$users = $users ?? [];
$pager = $pager ?? null;
$search = $search ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', system-ui, 'Segoe UI', -apple-system, BlinkMacSystemFont, Roboto, sans-serif;
            background: radial-gradient(ellipse at 20% 30%, #0A0F1F, #020617);
            min-height: 100vh;
            padding: 48px 24px;
            color: #F1F5F9;
        }

        .container {
            max-width: 1280px;
            margin: 0 auto;
            background: rgba(15, 25, 45, 0.55);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(56, 189, 248, 0.18);
            border-radius: 44px;
            padding: 40px 36px;
            box-shadow: 0 25px 40px -12px rgba(0, 0, 0, 0.6), 0 0 0 1px rgba(56, 189, 248, 0.08) inset;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 24px;
            margin-bottom: 36px;
            border-bottom: 1px solid rgba(56, 189, 248, 0.2);
            padding-bottom: 20px;
        }

        .title {
            font-size: 38px;
            font-weight: 800;
            background: linear-gradient(125deg, #FFFFFF, #90E0FF);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            letter-spacing: -0.02em;
        }

        .top-actions {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
            align-items: center;
        }

        .search-box {
            padding: 12px 18px;
            border: 1px solid rgba(56, 189, 248, 0.4);
            outline: none;
            border-radius: 60px;
            background: rgba(0, 10, 25, 0.7);
            color: #EFF6FF;
            width: 260px;
            font-size: 14px;
            font-weight: 500;
            backdrop-filter: blur(4px);
            transition: 0.2s;
        }

        .search-box:focus {
            border-color: #38BDF8;
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.3);
            background: #071427;
            outline: none;
        }

        .search-box::placeholder {
            color: #82B4FF;
        }

        .btn {
            border: none;
            padding: 12px 22px;
            border-radius: 44px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(30, 64, 175, 0.75);
            backdrop-filter: blur(4px);
            color: white;
            border: 1px solid rgba(59, 130, 246, 0.5);
        }

        .btn:focus {
            outline: none;
        }

        .search-btn {
            background: linear-gradient(115deg, #0E4D92, #1E3A8A);
            border: none;
            box-shadow: 0 2px 6px rgba(0, 160, 255, 0.2);
        }

        .add-btn {
            background: linear-gradient(115deg, #2563EB, #1D4ED8);
            box-shadow: 0 5px 12px rgba(37, 99, 235, 0.25);
        }

        .btn:hover {
            transform: translateY(-2px);
            filter: brightness(1.05);
            box-shadow: 0 10px 20px -5px rgba(0, 120, 255, 0.4);
        }

        .success {
            background: rgba(16, 185, 129, 0.12);
            border: 1px solid rgba(52, 211, 153, 0.3);
            color: #B4F0D5;
            padding: 16px 24px;
            border-radius: 32px;
            margin-bottom: 28px;
            font-weight: 500;
            backdrop-filter: blur(8px);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 32px;
            overflow: hidden;
        }

        th {
            background: rgba(15, 35, 65, 0.7);
            color: #CFF3FF;
            padding: 18px 20px;
            text-align: left;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        td {
            padding: 20px 20px;
            border-bottom: 1px solid rgba(72, 187, 255, 0.12);
            color: #E2EDFF;
            font-weight: 500;
        }

        tr:hover td {
            background: rgba(56, 189, 248, 0.08);
        }

        .avatar {
            width: 60px;
            height: 60px;
            border-radius: 100px;
            object-fit: cover;
            border: 2.5px solid #3B82F6;
            box-shadow: 0 6px 12px -6px rgba(0, 0, 0, 0.4);
        }

        .empty {
            text-align: center;
            padding: 48px 20px;
            color: #9AC8FF;
            font-size: 16px;
        }

        .pagination {
            margin-top: 40px;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .pagination a,
        .pagination span {
            padding: 10px 18px;
            border-radius: 40px;
            text-decoration: none;
            background: rgba(15, 35, 65, 0.6);
            backdrop-filter: blur(4px);
            color: #CFF3FF;
            transition: 0.2s;
            border: 1px solid rgba(59, 130, 246, 0.3);
            font-weight: 500;
            font-size: 14px;
            min-width: 44px;
            text-align: center;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .pagination a:hover {
            background: #2563EB;
            border-color: #60A5FA;
            transform: scale(1.02);
            color: white;
            box-shadow: 0 6px 14px rgba(37, 99, 235, 0.3);
        }

        .pagination .active {
            background: linear-gradient(145deg, #3B82F6, #1E40AF);
            border-color: #93C5FD;
            color: white;
            font-weight: 700;
            box-shadow: 0 8px 16px -6px #1E3A8A;
        }

        @media (max-width: 720px) {
            .container {
                padding: 28px 20px;
            }
            .header {
                flex-direction: column;
                align-items: stretch;
            }
            .top-actions form {
                width: 100%;
            }
            .search-box {
                width: 100%;
            }
            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
            th, td {
                padding: 12px 16px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1 class="title">User Directory</h1>
        <div class="top-actions">
            <form method="GET" action="/users" style="display:flex; gap:12px; align-items:center;">
                <input type="text" name="search" placeholder="Search by name or email..." value="<?= esc($search) ?>" class="search-box">
                <button type="submit" class="btn search-btn">Search</button>
            </form>
            <a href="/users/create" class="btn add-btn">+ Add User</a>
        </div>
    </div>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="success"><?= esc(session()->getFlashdata('success')) ?></div>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Avatar</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
        <?php if(!empty($users)): ?>
            <?php foreach($users as $user): ?>
                <tr>
                    <td><?= esc((string)($user['id'] ?? '')) ?></td>
                    <td>
                        <?php if(isset($user['avatar']) && $user['avatar']): ?>
                            <img src="/<?= esc($user['avatar']) ?>" class="avatar" alt="avatar">
                        <?php else: ?>
                            <div class="avatar" style="background: #2d3748; display: inline-flex; align-items: center; justify-content: center;">?</div>
                        <?php endif; ?>
                    </td>
                    <td><?= esc((string)($user['name'] ?? '')) ?></td>
                    <td><?= esc((string)($user['email'] ?? '')) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" class="empty">No users found. Create your first user.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>

    <?php if(isset($pager) && $pager !== null): ?>
        <div class="pagination">
            <?= $pager->links() ?>
        </div>
    <?php endif; ?>
</div>
</body>
</html>