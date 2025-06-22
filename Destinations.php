<?php
session_start();
include './config/db.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; 
    $sql = "SELECT profile_type FROM Profile WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($profile_type);
        $stmt->fetch();
        $stmt->close();

        if ($profile_type === "Empresa" && basename($_SERVER['PHP_SELF']) !== 'Inicio.php') {
            header("Location: Includes/Inicio.php");
            exit;
        } 
        if ($profile_type === "Turista" && basename($_SERVER['PHP_SELF']) !== 'Destinations.php') {
            header("Location: Destinations.php");
            exit;
        }
    } else {
        echo "Error al preparar la consulta.";
    }
}

$headerFile = isset($_SESSION['user_id']) ? './Includes/Header.php' : './Includes/Header2.php';

$states_query = "SELECT * FROM States";
$states_result = $conn->query($states_query);

$destinations_query = "SELECT d.*, s.name AS state_name 
                       FROM Destinations d 
                       JOIN States s ON d.state_id = s.id 
                       WHERE d.status = 1";
$destinations_result = $conn->query($destinations_query);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./Assets/css/Destinations.css">
</head>

<style>
.filter-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: 24px;
    padding: 32px;
    box-shadow:
        0 20px 40px rgba(0, 0, 0, 0.1),
        0 10px 20px rgba(0, 0, 0, 0.05),
        inset 0 1px 0 rgba(255, 255, 255, 0.8);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transform: translateY(0);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.filter-card:hover {
    transform: translateY(-4px);
    box-shadow:
        0 32px 64px rgba(0, 0, 0, 0.12),
        0 16px 32px rgba(0, 0, 0, 0.08),
        inset 0 1px 0 rgba(255, 255, 255, 0.9);
}

.filter-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #ff6b6b, #feca57, #48dbfb, #ff9ff3);
    background-size: 300% 300%;
    animation: gradient-shift 3s ease-in-out infinite;
}

@keyframes gradient-shift {

    0%,
    100% {
        background-position: 0% 50%;
    }

    50% {
        background-position: 100% 50%;
    }
}

.filter-header {
    text-align: center;
    margin-bottom: 32px;
}

.filter-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 20px;
    background: linear-gradient(135deg, #ff6b6b, #ee5a52);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 8px 16px rgba(238, 90, 82, 0.3);
    animation: float 3s ease-in-out infinite;
}

@keyframes float {

    0%,
    100% {
        transform: translateY(0px);
    }

    50% {
        transform: translateY(-8px);
    }
}

.filter-icon i {
    font-size: 32px;
    color: white;
}

.filter-title {
    font-size: 24px;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 8px;
    line-height: 1.2;
}

.filter-subtitle {
    color: #7f8c8d;
    font-size: 16px;
    font-weight: 400;
    line-height: 1.4;
}

.filter-form {
    margin-bottom: 32px;
}

.input-group {
    margin-bottom: 28px;
}

.input-label {
    display: flex;
    align-items: center;
    font-size: 14px;
    font-weight: 600;
    color: #34495e;
    margin-bottom: 12px;
}

.input-label i {
    margin-right: 8px;
    color: #e74c3c;
    font-size: 16px;
}

.select-wrapper {
    position: relative;
}

.custom-select {
    width: 100%;
    padding: 16px 20px;
    font-size: 16px;
    font-weight: 500;
    color: #2c3e50;
    background: white;
    border: 2px solid #ecf0f1;
    border-radius: 16px;
    outline: none;
    appearance: none;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    padding-right: 50px;
}

.custom-select:focus {
    border-color: #3498db;
    box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.1);
    transform: translateY(-2px);
}

.custom-select:hover {
    border-color: #bdc3c7;
}

.select-arrow {
    position: absolute;
    right: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: #7f8c8d;
    pointer-events: none;
    transition: all 0.3s ease;
}

.custom-select:focus+.select-arrow {
    color: #3498db;
    transform: translateY(-50%) rotate(180deg);
}

.filter-button {
    width: 100%;
    padding: 18px 24px;
    background: linear-gradient(135deg, #2ecc71, #27ae60);
    color: white;
    border: none;
    border-radius: 16px;
    font-size: 18px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    box-shadow: 0 8px 16px rgba(46, 204, 113, 0.3);
}

.filter-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 24px rgba(46, 204, 113, 0.4);
    background: linear-gradient(135deg, #27ae60, #229954);
}

.filter-button:active {
    transform: translateY(0);
    box-shadow: 0 4px 8px rgba(46, 204, 113, 0.3);
}

.button-content {
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    z-index: 1;
}

.button-content i {
    margin-right: 12px;
    font-size: 18px;
}

.button-text {
    font-weight: 600;
}

.button-ripple {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}

.filter-button:active .button-ripple {
    width: 300px;
    height: 300px;
}

.filter-stats {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 24px;
    border-top: 1px solid #ecf0f1;
}

.stat-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    flex: 1;
}

.stat-item i {
    font-size: 20px;
    color: #3498db;
    margin-bottom: 8px;
}

.stat-item span {
    font-size: 12px;
    font-weight: 600;
    color: #7f8c8d;
    line-height: 1.2;
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        max-width: 100%;
        margin: 0 16px;
    }

    .filter-card {
        padding: 24px;
    }

    .filter-title {
        font-size: 20px;
    }

    .filter-subtitle {
        font-size: 14px;
    }

    .filter-icon {
        width: 64px;
        height: 64px;
        margin-bottom: 16px;
    }

    .filter-icon i {
        font-size: 24px;
    }

    .custom-select {
        padding: 14px 16px;
        font-size: 15px;
        padding-right: 45px;
    }

    .filter-button {
        padding: 16px 20px;
        font-size: 16px;
    }

    .filter-stats {
        flex-direction: column;
        gap: 16px;
    }

    .stat-item {
        flex-direction: row;
        gap: 8px;
    }

    .stat-item i {
        margin-bottom: 0;
        font-size: 16px;
    }
}

@media (max-width: 480px) {
    body {
        padding: 16px;
    }

    .filter-card {
        padding: 20px;
        border-radius: 20px;
    }

    .filter-stats {
        gap: 12px;
    }

    .stat-item span {
        font-size: 11px;
    }
}

/* Animaciones de entrada */
.filter-card {
    animation: slideUp 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Estados de focus mejorados */
.custom-select:focus,
.filter-button:focus {
    outline: 2px solid #3498db;
    outline-offset: 2px;
}

/* Mejoras para accesibilidad */
@media (prefers-reduced-motion: reduce) {

    *,
    *::before,
    *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}
</style>

<body>

    <?php include $headerFile; ?>


    <section class="upcoming events-section">
        <div class="container mt-3">
            <div class="filter-card" style="border-radius: 20px; padding: 2rem;">
                <div class="filter-header mb-4 text-center">
                    <div class="filter-icon mb-2">
                        <i class="fas fa-filter fa-lg text-white"></i>
                    </div>
                    <h2 class="filter-title mb-1">Filtrar Posadas por Estado</h2>
                </div>

                <form action="Inns_State.php" method="GET" class="filter-form">
                    <div class="input-group mb-4">
                        <label for="stateFilter" class="input-label mb-2 d-block">
                            <i class="fas fa-map-marker-alt text-danger"></i> Selecciona un Estado
                        </label>
                        <div class="select-wrapper position-relative w-100">
                            <select id="stateFilter" name="state" class="form-select w-100"
                                style="border-radius: 12px; padding-right: 2rem;">
                                <option value="">Elige tu destino...</option>
                                <option value="all">🌍 Todos los Estados</option>
                                <?php while ($state = $states_result->fetch_assoc()): ?>
                                <option value="<?php echo $state['id']; ?>">📍 <?php echo $state['name']; ?></option>
                                <?php endwhile; ?>
                            </select>
                            <div class="select-arrow position-absolute top-50 end-0 translate-middle-y pe-3">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-light w-100" style="font-size: 1.1rem; border-radius: 30px;">
                        <i class="fas fa-search me-2 text-primary"></i> Buscar Posadas
                    </button>
                </form>
            </div>
        </div>


        <div id="destinationsContainer" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 m-3">
            <?php while ($destination = $destinations_result->fetch_assoc()): ?>
            <div class="col">
                <div class="card h-100 shadow-sm border-0">
                    <img src="<?php echo $destination['image_url']; ?>" class="card-img-top object-fit-cover"
                        alt="<?php echo $destination['name']; ?>"
                        style="height: 250px; border-top-left-radius: .75rem; border-top-right-radius: .75rem;">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h5 class="card-title fw-bold">
                            <i class="fas fa-map-marker-alt text-success me-2"></i><?php echo $destination['name']; ?>
                        </h5>
                        <p class="card-text small text-muted"><?php echo $destination['description']; ?></p>
                    </div>
                    <div class="card-footer bg-transparent border-0 text-end">
                        <small class="text-body-secondary">
                            <i
                                class="fas fa-location-dot text-primary me-1"></i><?php echo $destination['state_name']; ?>
                        </small>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        </div>
    </section>

    <?php include './Includes/footer.php'; ?>
</body>

</html>