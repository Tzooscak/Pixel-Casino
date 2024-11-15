const app = function () {
    var wallet = 1000;
    const game = {};
    const suits = ["spades", "hearts", "clubs", "diams"];
    const ranks = [2, 3, 4, 5, 6, 7, 8, 9, 10, "J", "Q", "K", "A"];
    const score = [0,0];
    function init() {
        buildGameBoard();
        turnOff(game.btnHit);
        turnOff(game.btnStand);
        turnOff(game.btnDeal);
        buildDeck();
        addClicker();
        scoreBoard();
    }

    function scoreBoard(){
        game.scoreboard.textContent = `Dealer ${score[0]} vs Player ${score[1]}`;
    }

    function buildDeck() {
        game.deck = suits.flatMap(suit => 
            ranks.map(rank => {
                let value = isNaN(rank) ? 10 : rank;
                value = (rank === "A") ? 11 : value;
    
                return {
                    suit: suit,
                    rank: rank,
                    value: value
                };
            })
        );
        Shuffle(game.deck);
        console.log(game.deck);
    }
    

    function Shuffle(cards){
        cards.sort(function(){
            return .5 - Math.random();    
        })
        return cards;
    }

    function addClicker(){
        game.btnBet.addEventListener("click",bet);
        game.btnDeal.addEventListener("click",deal);
        game.btnStand.addEventListener("click",playerStand);
        game.btnHit.addEventListener("click",nextCard);
    }

    function deal() {
        game.deck = Shuffle(game.deck);
        game.playerHand = [];
        game.dealerHand = [];
        game.start = true;

        game.playerCards.innerHTML = "";
        game.dealerCards.textContent = "";
        takeCard(game.dealerHand,game.dealerCards,true);
        takeCard(game.dealerHand,game.dealerCards,false);
        takeCard(game.playerHand,game.playerCards,false);
        takeCard(game.playerHand,game.playerCards,false);
        updateCount();
        turnOff(game.btnDeal);
    }

    function playerStand() {
        showModalMessage("Dealer Turn", 1500);

        if (game.cardBack) {
            game.cardBack.remove();
            let firstCard = game.deck.shift();
            game.dealerHand.unshift(firstCard);
            showCard(firstCard, game.dealerCards);
        }

        DealerPlay();
        turnOff(game.btnHit);
        turnOff(game.btnStand);
    }

    function nextCard() {
        takeCard(game.playerHand, game.playerCards, false);
        updateCount();
    }

    function findWinner() {
        let player = scorer(game.playerHand);
        let dealer = scorer(game.dealerHand);
        console.log(player,dealer);
        if(player > 21){
            game.status.textContent = "Busted! with: "+ player;
        }
        else if(dealer > 21){
            game.status.textContent = "Dealer Busted with! "+ dealer;
        }

        if(player == dealer){
            game.status.textContent = "Draw no Winer";
        } else if((player<22 && player>dealer) || dealer>21){
            game.status.textContent = "Player Wins with: "+ player;
            score[1]++;
        } else {
            game.status.textContent = "Dealer Wins with: "+ dealer;
            score[0]++;
        }
        scoreBoard();
        turnOn(game.btnDeal);
        turnOff(game.btnBet);
        turnOff(game.btnStand);
        
    }

    function DealerPlay(){
        let dealer = scorer(game.dealerHand);
        game.cardBack.style.display = "none";
        game.status.textContent = "Dealer score" +dealer+" ";
        if (dealer >= 17){
            game.dealerScore.textContent = dealer;
        } else {
            takeCard(game.dealerHand, game.dealerCards,false);
            game.dealerScore.textContent = dealer;
            DealerPlay();
        }

        findWinner();
    }

    function updateCount(){
        let player = scorer(game.playerHand);
        let dealer = scorer(game.dealerHand);
        console.log(player,dealer);
        game.playerScore.textContent = player;
        game.dealerScore.textContent = dealer;
        if(player < 21){
            turnOn(game.btnHit);
            turnOn(game.btnStand);
            game.status.textContent = "Stand or take another card";
        }
        else if(player > 21){
            game.status.textContent = "Busted! with: "+ player;
            showModalMessage("Calculating winner...", 1500);
            findWinner();
        }
        else{
            game.status.textContent = "Dealer in Play to minimum 17";
            DealerPlay(dealer)
        }
    }

    function scoreAce(val,aces){
        if(val<21){
            return val;
        } 
        else if(aces > 0){
            aces--;
            val = val -10;
            return scoreAce(val,aces);
        }
        else{
            return val;
        }
    }

    function scorer(hand){
        let total = 0;
        let ace = 0;
        hand.forEach(function(card){
            if(card.rank == "A"){
                ace++;
            }
            total += Number(card.value);
        });
        if(ace > 0 && total > 21){
            total = scoreAce(total,ace)
        }

        return Number(total);
    }

    function bet() {
        let betValue = parseInt(game.inputBet.value);
        if (betValue > wallet) {
            game.status.textContent = "Insufficient funds!";
            return;
        }
    
        turnOn(game.btnDeal);

        wallet -= betValue;
        sessionStorage.setItem('wallet', wallet);
        game.status.textContent = "Bet placed: " + betValue;
    }
    

    function probality(n){
        return !!n && Math.random() <= n; // 1 is 100% and the double !! is just conversion 
    }

    function takeCard(hand, ele, h) {
        
        if (game.deck.length == 0) {
            buildDeck();
        }
    
        let customCard;
        if (probality(0.01) && hand.length > 2) {
            if (probality(0.5)) {
                customCard = {
                    suit: "special",
                    rank: "Devil",
                    value: "-666"
                }
            } else {
                customCard = {
                    suit: "special",
                    rank: "TrollAngel",
                    value: "+777"
                }
            }
        }
    
        let temp;
    
        if (h) {
            game.cardBack = document.createElement("div");
            game.cardBack.classList.add("cardB");
            ele.append(game.cardBack);
        } 
        if (customCard != null) {
            temp = customCard;
            hand.push(temp);
            showCard(temp, ele);
        } else {
            temp = game.deck.shift();
            hand.push(temp);
            showCard(temp, ele);
            console.log("Dealer második lap:", temp); 
        }
    }
    

    function showCard(card, ele){
        if (card != undefined) {
            let div = document.createElement("div");
            div.classList.add("card");
            if (card.suit == "hearts" || card.suit == "diams") {
                div.classList.add("red");
            }
            let span1 = document.createElement("div");
            span1.innerHTML = card.rank + "&" + card.suit + ";";
            span1.classList.add("tiny");
            div.appendChild(span1);

            let span2 = document.createElement("div");
            span2.innerHTML = card.rank;
            span2.classList.add("big");
            div.appendChild(span2);

            let span3 = document.createElement("div");
            span3.innerHTML = "&" + card.suit + ";";
            span3.classList.add("big");
            div.appendChild(span3);

            ele.appendChild(div);
        }
    }

    function turnOff(btn){
        btn.disabled = true;
        btn.style.backgroundColor = "#ddd";
    }
    function turnOn(btn){
        btn.disabled = false;
        btn.style.backgroundColor = "#000";
    }

    function showModalMessage(message, duration = 2000) {
        game.modal.textContent = message;
        game.modal.style.display = 'block';
    
        setTimeout(() => {
            game.modal.style.display = 'none';
        }, duration);
    }
    

    function buildGameBoard() {
        game.main = document.querySelector('#game');

        game.scoreboard = document.createElement('div');
        //game.scoreboard.textContent = "Dealer 0 vs Player 0";
        game.scoreboard.style.fontSize = "2em";
        game.main.append(game.scoreboard);
    
        game.table = document.createElement('div');
        game.dealer = document.createElement('div');
        game.dealerCards = document.createElement('div');
        game.dealerCards.textContent = "DEALER CARD";
        game.dealerScore = document.createElement('div');
        game.dealerScore.textContent = "-";
        game.dealerScore.classList.add('score');
        
        game.dealer.append(game.dealerScore);
        game.table.append(game.dealer);
        game.dealer.append(game.dealerCards);

        game.player = document.createElement('div');
        game.playerCards = document.createElement('div');
        game.playerCards.textContent = "PLAYER CARD";
        game.playerScore = document.createElement('div');
        game.playerScore.textContent = "-";
        game.playerScore.classList.add('score');
        
        game.player.append(game.playerScore);
        game.table.append(game.player);
        game.player.append(game.playerCards);

        game.dashboard = document.createElement('div');
        game.status = document.createElement('div');
        game.status.classList.add('message');
        game.status.textContent = "Message for Player";

        game.btnDeal = document.createElement('button');
        game.btnDeal.textContent = "DEAL";
        game.btnDeal.classList.add('btn');
        game.dashboard.append(game.btnDeal);

        game.btnHit = document.createElement('button');
        game.btnHit.textContent = "HIT";
        game.btnHit.classList.add('btn');
        game.dashboard.append(game.btnHit);

        game.btnStand = document.createElement('button');
        game.btnStand.textContent = "STAND";
        game.btnStand.classList.add('btn');
        game.dashboard.append(game.btnStand);

        const betArea = document.querySelector('#bet');

        game.inputLabel = document.createElement('label');
        game.inputLabel.textContent = "Bet: " + game.inputBet?.value || 10000;
        betArea.append(game.inputLabel);
        betArea.append(document.createElement('br'));

        game.inputBet = document.createElement('input');
        game.inputBet.type = "range";
        game.inputBet.min = 0;
        game.inputBet.max = wallet;
        game.inputBet.style.width = "100%";
        game.inputBet.style.marginTop = "1em";
        game.inputBet.value = 0;
        betArea.append(game.inputBet);

        game.inputBet.addEventListener('input', function() {
            game.inputLabel.textContent = "Bet: " + game.inputBet.value;
        });

        game.btnBet = document.createElement('button');
        game.btnBet.textContent = "BET";
        game.btnBet.classList.add('btn');
        betArea.append(game.btnBet);


        game.dashboard.append(game.status);

        game.table.append(game.dashboard);
        game.main.append(game.table);

        game.modal = document.createElement('div');
        game.modal.classList.add('modal');
        game.modal.style.display = 'none';
        game.main.append(game.modal);


        console.log(wallet);
    }

    

    return {
        init : init
    }
}();