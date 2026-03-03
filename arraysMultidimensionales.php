<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $matriz = array(
        "seccionA" => array("1" => 1,"2" => 2, "3" => 3),
        "seccionB" => array("1" => 4, "2" => 5, "3" => 6),
        "seccionC" => array("1" => 7, "2" => 8, "3" => 9)
    );
    $json = json_encode($matriz);
    ?>

    <style>
        body{font-family: Arial, Helvetica, sans-serif; padding:20px}
        .grid{display:grid; grid-template-columns: repeat(3, 120px); gap:12px}
        .cell{position:relative; width:120px; height:120px; background:#f2f2f2; display:flex; align-items:center; justify-content:center; border-radius:8px; transition: transform .2s, background .2s; box-shadow:0 2px 6px rgba(0,0,0,.08)}
        .cell h3{margin:0; font-size:20px}
        .cell .meta{position:absolute; top:6px; left:8px; font-size:12px; color:#666}
        .overlay{position:absolute; inset:0; display:flex; align-items:center; justify-content:center}
        .overlay .circle{width:64%; height:64%; border-radius:50%; background:rgba(0,0,0,0.8); filter:blur(6px);}
        .cell.highlight{background:linear-gradient(135deg,#ffefba,#ffc3a0); transform:scale(1.03); color:#000}
        .cell.highlight2{background:linear-gradient(135deg,#c1ffd7,#7ee8fa);}
        .cell.highlight3{background:linear-gradient(135deg,#ffd3e0,#fbc2eb);}
        .value{font-weight:700; font-size:22px}
    </style>

    <div>
        <h2>Visualización de la matriz (3x3) — se resaltan 3 posiciones aleatorias</h2>
        <div class="grid" id="grid"></div>
    </div>

    <script>
        const matriz = <?php echo $json; ?>;
        const cells = [];
        for (const sec in matriz) {
            for (const k in matriz[sec]) {
                cells.push({section: sec, key: k, value: matriz[sec][k]});
            }
        }
        const grid = document.getElementById('grid');
        // Render inicial
        cells.forEach((c, idx) => {
            const el = document.createElement('div');
            el.className = 'cell';
            el.dataset.section = c.section;
            el.dataset.key = c.key;
            el.innerHTML = `<div class="meta">${c.section} / ${c.key}</div><div class="value">${c.value}</div>`;
            const overlay = document.createElement('div');
            overlay.className = 'overlay';
            overlay.innerHTML = '<div class="circle"></div>';
            el.appendChild(overlay);
            grid.appendChild(el);
        });

        function pickN(n){
            const picked = new Set();
            while(picked.size < n){
                const i = Math.floor(Math.random()*cells.length);
                picked.add(i);
            }
            return Array.from(picked);
        }
        const colors = ['highlight','highlight2','highlight3'];
        function refresh(){
            const pick = pickN(3);
            const elements = document.querySelectorAll('.cell');
            elements.forEach((el, i) => {
                el.classList.remove('highlight','highlight2','highlight3');
                const overlay = el.querySelector('.overlay');
                overlay.style.display = 'flex';
            });
            pick.forEach((pidx, i) => {
                const el = elements[pidx];
                if(!el) return;
                el.classList.add(colors[i%colors.length]);
                const overlay = el.querySelector('.overlay');
                overlay.style.display = 'none';
            });
        }

        // Actualizar cada segundo
        refresh();
        setInterval(refresh, 1000);
    </script>
</body>
</html>