<?php

if (!isset($_SESSION['balance'])) {
    $_SESSION['balance'] = 1000;
}

$result = null;
$winningNumber = null;
$winnings = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $betAmount = intval($_POST['betAmount']);
    $betType = $_POST['betType'];
    $betValue = $_POST['betValue'];
    
    if ($betAmount <= $_SESSION['balance']) {
        $_SESSION['balance'] -= $betAmount;
        $winningNumber = rand(0, 36);
        $winningColor = $winningNumber === 0 ? 'green' : 
                        ($winningNumber % 2 === 0 ? 'black' : 'red');
        
        $won = false;
        $multiplier = 0;
        
        if ($betType === 'number' && intval($betValue) === $winningNumber) {
            $won = true;
            $multiplier = 35;
        } elseif ($betType === 'color' && $betValue === $winningColor) {
            $won = true;
            $multiplier = 2;
        } elseif ($betType === 'evenodd') {
            $isEven = $winningNumber !== 0 && $winningNumber % 2 === 0;
            if (($betValue === 'even' && $isEven) || 
                ($betValue === 'odd' && !$isEven && $winningNumber !== 0)) {
                $won = true;
                $multiplier = 2;
            }
        }
        
        $winnings = $won ? $betAmount * $multiplier : 0;
        $_SESSION['balance'] += $winnings;
        
        $result = [
            'number' => $winningNumber,
            'color' => $winningColor,
            'won' => $won,
            'amount' => $winnings
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rulett</title>
    <link rel="stylesheet" href="assets/css/Roulette.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Rulett</h1>
            <div class="balance">💰 <?php echo number_format($_SESSION['balance']); ?> érme</div>
        </div>
        <div class="roulette-container">     
            <div class="roulette-strip-wrapper">
                <div class="roulette-marker"></div>
                <div class="roulette-strip">
                    <?php
                    function createNumberSequence() {
                        $html = '<div class="roulette-numbers">';
                        for ($i = 0; $i <= 36; $i++) {
                            $colorClass = $i === 0 ? "green" : ($i % 2 === 0 ? "black" : "red");
                            $html .= "<div class='roulette-slot $colorClass' data-number='$i'>$i</div>";
                        }
                        $html .= '</div>';
                        return $html;
                    }
                    
                    // Repeat the sequence multiple times
                    $sequence = createNumberSequence();
                    echo $sequence . $sequence . $sequence . $sequence;
                    ?>
                </div>
            </div>
        </div>

        <form method="POST" class="bet-area" id="betForm">
            <div class="bet-grid">
                <!-- Bet Amount Section -->
                <div class="bet-section">
                    <h3>Tét összege</h3>
                    <div class="bet-amount-options">
                        <button type="button" class="bet-button" data-amount="10">10</button>
                        <button type="button" class="bet-button" data-amount="50">50</button>
                        <button type="button" class="bet-button" data-amount="100">100</button>
                        <button type="button" class="bet-button" data-amount="500">500</button>
                        <button type="button" class="bet-button" data-amount="1000">1K</button>
                        <button type="button" class="bet-button" data-amount="5000">5K</button>
                        <button type="button" class="bet-button" data-amount="10000">10K</button>
                        <button type="button" class="bet-button" data-amount="50000">50K</button>
                    </div>
                    <input type="number" name="betAmount" class="bet-input" required min="1" value="10">
                </div>

                <!-- Bet Type Section -->
                <div class="bet-section">
                    <h3>Fogadás típusa</h3>
                    <div class="bet-type selected" data-type="color">Szín</div>
                    <div class="bet-type" data-type="number">Szám</div>
                    <div class="bet-type" data-type="evenodd">Páros/Páratlan</div>
                    <input type="hidden" name="betType" value="color">
                </div>

                <!-- Bet Value Section -->
                <div class="bet-section">
                    <h3>Választott érték</h3>
                    <div class="color-options bet-values" id="colorOptions">
                        <div class="color-option red-opt selected" data-value="red"></div>
                        <div class="color-option black-opt" data-value="black"></div>
                        <div class="color-option green-opt" data-value="green"></div>
                    </div>
                    
                    <div class="number-grid bet-values" id="numberOptions" style="display: none;">
                        <?php for($i = 0; $i <= 36; $i++): ?>
                            <button type="button" class="number-button" data-value="<?php echo $i; ?>"><?php echo $i; ?></button>
                        <?php endfor; ?>
                    </div>
                    
                    <div class="bet-values" id="evenOddOptions" style="display: none;">
                        <div class="bet-type" data-value="even">Páros</div>
                        <div class="bet-type" data-value="odd">Páratlan</div>
                    </div>
                    
                    <input type="hidden" name="betValue" value="red" required>
                </div>
            </div>
            <button type="button" class="spin-button">Pörgetés 🎲</button>
        </form>

        <?php if ($result !== null): ?>
            <div class="result <?php echo $result['won'] ? 'win-animation' : ''; ?>">
                Nyerőszám: <?php echo $result['number']; ?> (<?php echo $result['color']; ?>)
                <?php if ($result['won']): ?>
                    <span style="color: #2ecc71">🎉 Nyertél <?php echo number_format($result['amount']); ?> érmét!</span>
                <?php else: ?>
                    <span style="color: #e74c3c">😢 Sajnos most nem nyertél!</span>
                <?php endif; ?>
            </div>
        <?php endif; ?>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Bet amount buttons
            const betButtons = document.querySelectorAll('.bet-button');
            const betInput = document.querySelector('input[name="betAmount"]');
            
            betButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const amount = button.dataset.amount;
                    betInput.value = amount;
                    betButtons.forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');
                });
            });

            // Bet type selection
            const betTypes = document.querySelectorAll('.bet-type');
            const betTypeInput = document.querySelector('input[name="betType"]');
            const valueOptionsContainers = {
                color: document.getElementById('colorOptions'),
                number: document.getElementById('numberOptions'),
                evenodd: document.getElementById('evenOddOptions')
            };

            betTypes.forEach(type => {
                type.addEventListener('click', () => {
                    betTypes.forEach(t => t.classList.remove('selected'));
                    type.classList.add('selected');
                    
                    const selectedType = type.dataset.type;
                    betTypeInput.value = selectedType;
                    
                    Object.entries(valueOptionsContainers).forEach(([key, container]) => {
                        container.style.display = key === selectedType ? 'grid' : 'none';
                    });
                });
            });

            // Bet value selection
            const betValueInput = document.querySelector('input[name="betValue"]');
            
            // Color options
            const colorOptions = document.querySelectorAll('.color-option');
            colorOptions.forEach(option => {
                option.addEventListener('click', () => {
                    colorOptions.forEach(opt => opt.classList.remove('selected'));
                    option.classList.add('selected');
                    betValueInput.value = option.dataset.value;
                });
            });

            // Number options
            const numberButtons = document.querySelectorAll('.number-button');
            numberButtons.forEach(button => {
                button.addEventListener('click', () => {
                    numberButtons.forEach(btn => btn.classList.remove('selected'));
                    button.classList.add('selected');
                    betValueInput.value = button.dataset.value;
                });
            });

            // Even/Odd options
            const evenOddOptions = document.querySelectorAll('#evenOddOptions .bet-type');
            evenOddOptions.forEach(option => {
                option.addEventListener('click', () => {
                    evenOddOptions.forEach(opt => opt.classList.remove('selected'));
                    option.classList.add('selected');
                    betValueInput.value = option.dataset.value;
                });
            });

            const strip = document.querySelector(".roulette-strip");
            const slotWidth = 65;
            const numberOfSlots = 37;
            const stripWidth = slotWidth * numberOfSlots;
            let currentPosition = 0;
            let isSpinning = false;

            function initializeStrip() {
                const containerWidth = document.querySelector('.roulette-container').offsetWidth;
                currentPosition = (containerWidth / 2) - (slotWidth / 2);
                strip.style.transform = `translateX(${currentPosition}px)`;
            }

            function resetStrip() {
                strip.style.transition = 'none';
                strip.style.transform = `translateX(${currentPosition}px)`;
            }

            function spin(winningNumber) {
                if (winningNumber === null || isSpinning) return;
                
                isSpinning = true;
                const spins = 3;
                const totalWidth = stripWidth * 4;
                const slotPosition = winningNumber * slotWidth;
                let spinDistance = (spins * stripWidth) + slotPosition;
                spinDistance = spinDistance - (currentPosition % stripWidth);

                strip.style.transition = 'transform 4s cubic-bezier(0.32, 0.64, 0.45, 1)';
                strip.style.transform = `translateX(-${spinDistance}px)`;

                setTimeout(() => {
                    isSpinning = false;
                    resetStrip();
                }, 4000);
            }

            document.querySelector(".spin-button").addEventListener("click", function() {
                if (isSpinning) return;

                const form = document.getElementById('betForm');
                const formData = new FormData(form);

                fetch(window.location.href, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const resultDiv = doc.querySelector('.result');
                    
                    if (resultDiv) {
                        const text = resultDiv.textContent;
                        const match = text.match(/Nyerőszám: (\d+)/);
                        if (match) {
                            const winningNumber = parseInt(match[1]);
                            spin(winningNumber);
                            
                            setTimeout(() => {
                                location.reload();
                            }, 4100);
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    isSpinning = false;
                });
            });

            initializeStrip();
            window.addEventListener('resize', initializeStrip);
        });
    </script>
</body>
</html>