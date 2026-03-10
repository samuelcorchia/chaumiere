<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Administration | La Chaumière du Télégraphe</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Source+Sans+Pro:wght@400;600&display=swap" rel="stylesheet">
    
    <!-- CSS -->
    <link rel="stylesheet" href="/css/style.css">
    <style>
        .admin-actions {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }
        .settings-panel {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .settings-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            margin-top: 20px;
        }
        .setting-card {
            background: var(--color-cream);
            padding: 25px;
            border-radius: 12px;
            text-align: center;
        }
        .setting-card label {
            display: block;
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--color-primary);
        }
        .setting-card input {
            width: 100px;
            padding: 12px;
            font-size: 1.5rem;
            text-align: center;
            border: 2px solid var(--color-light);
            border-radius: 8px;
            font-weight: 700;
        }
        .setting-card input:focus {
            border-color: var(--color-secondary);
            outline: none;
        }
        .setting-card small {
            display: block;
            margin-top: 8px;
            color: var(--color-text-light);
        }
        .quota-info {
            background: linear-gradient(135deg, #2d5016 0%, #4a7c23 100%);
            color: white;
            padding: 20px 25px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
        }
        .quota-info .quota-text {
            font-size: 1.1rem;
        }
        .quota-info .quota-numbers {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
        }
        .quota-number {
            text-align: center;
        }
        .quota-number .value {
            font-size: 2rem;
            font-weight: 700;
        }
        .quota-number .label {
            font-size: 0.85rem;
            opacity: 0.9;
        }
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.6);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }
        .modal-content {
            background: white;
            padding: 40px;
            border-radius: 20px;
            max-width: 700px;
            width: 95%;
            max-height: 90vh;
            overflow-y: auto;
        }
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        .modal-header h3 {
            margin: 0;
        }
        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--color-text-light);
        }
        .source-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .source-badge.online {
            background: #e3f2fd;
            color: #1565c0;
        }
        .source-badge.phone {
            background: #fff3e0;
            color: #e65100;
        }
        .btn-phone {
            background: linear-gradient(135deg, #e65100 0%, #ff8f00 100%);
        }
        .btn-phone:hover {
            box-shadow: 0 10px 30px rgba(230, 81, 0, 0.3);
        }
        .btn-tables {
            background: linear-gradient(135deg, #5c6bc0 0%, #7986cb 100%);
        }
        .btn-tables:hover {
            box-shadow: 0 10px 30px rgba(92, 107, 192, 0.3);
        }
        
        /* Tables Management */
        .tables-panel {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .tables-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }
        .table-item {
            background: var(--color-cream);
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            border: 3px solid transparent;
            cursor: pointer;
            transition: all 0.2s;
        }
        .table-item:hover {
            border-color: var(--color-secondary);
        }
        .table-item.selected {
            border-color: var(--color-accent);
            background: #fff8e1;
        }
        .table-item.occupied {
            background: #ffebee;
            border-color: #e57373;
        }
        .table-item .table-number {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--color-primary);
        }
        .table-item .table-capacity {
            font-size: 0.85rem;
            color: var(--color-text-light);
        }
        .add-table-form {
            display: flex;
            gap: 15px;
            margin-top: 20px;
            padding: 20px;
            background: var(--color-light);
            border-radius: 10px;
        }
        .add-table-form input {
            padding: 10px 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
        }
        .add-table-form input:focus {
            border-color: var(--color-secondary);
            outline: none;
        }
        
        /* Tables selection in reservation */
        .tables-selection {
            margin-top: 20px;
            padding: 20px;
            background: #f5f5f5;
            border-radius: 12px;
        }
        .tables-selection h4 {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .selected-tables-summary {
            margin-top: 15px;
            padding: 15px;
            background: #e8f5e9;
            border-radius: 8px;
            color: #2e7d32;
        }
        .tables-mini-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
            gap: 10px;
        }
        .table-mini {
            padding: 10px;
            text-align: center;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 0.9rem;
        }
        .table-mini.available {
            background: #e8f5e9;
            border: 2px solid #a5d6a7;
        }
        .table-mini.available:hover {
            background: #c8e6c9;
        }
        .table-mini.selected {
            background: var(--color-accent);
            color: white;
            border-color: var(--color-accent);
        }
        .table-mini.occupied {
            background: #ffebee;
            border: 2px solid #ef9a9a;
            cursor: not-allowed;
            opacity: 0.7;
        }
        .assigned-tables {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
        }
        .table-tag {
            background: var(--color-secondary);
            color: white;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 600;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
</head>