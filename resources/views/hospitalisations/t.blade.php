<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
  </head>
  <body>
    <!-- ✅ id should match your JS code -->
    <canvas id="canvas" width="500" height="500"></canvas>
    <script>
    const canvas = document.getElementById('canvas');
    console.log(canvas); // 👉️ null

    // ⛔️ Cannot read properties of null (reading 'getContext')
    const ctx = canvas.getContext('2d');
    </script>
  </body>
</html>