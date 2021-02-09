<template>
  <div id="app">
    <div class="count-section">
      Ход: {{ shuffleCount }}
    </div>

    <div class="count-section-left">
      Время:   {{ round(time/3600) }}:{{ round(time/60) }}:{{ round(time%60) }}
    </div>

    <h1 class="title">
      Пятнашки
    </h1>

    <input type="text" v-model="test1">

    <div class="main-buttons" @click="shuffleDeck">
      <div class="button is-primary">

        <a v-if="firstStart">Начать</a>
        <a v-else>Рестарт</a>
      </div>
    </div>


    <transition-group :name="shuffleSpeed" tag="div" class="deck">
      <div v-for=" block in  blocks" :key=" block.id" class="block" @click="blockMove(block.rank)">
        <a> {{block.rank}}</a>
      </div>
    </transition-group>
    <transition name="fade">
      <div class="blockWin" v-if="winModal"><h1>Победа!</h1></div>
    </transition>

  </div>
</template>

<script>
  import Vue from 'vue';

  let interval;

  export default {
    name: 'app',
    data () {
      return {
          ranks: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', ' '],
          blocks: [],
          shuffleSpeed: 'shuffleFast',
          isDeckShuffled: false,
          winModal: false,
          shuffleCount: 0,
          time: 0,
          firstStart: true,
          test1: '',
      }
    },

    beforeCreate() {
      
    },

    created() {
        this.displayInitialDeck();
    },

    mounted() {
        if (localStorage.name) {
            this.test1 = localStorage.name;
        }
    },
      
    watch: {
        test1(newName) {
            localStorage.name = newName;
        }
    },

    methods: {
        round(time) {
          let r = Math.floor(time);

          if (r === 0) {
              return '00'
          } else {
              if ((r/10) > 1) {
                  return r
              } else {
                  return ('0' + r)
              }

          }

        },

        blockMove(rank) {
            
            if (!this.firstStart) {
                let indexEmpty = this.blocks.map(function(e) { return e.rank; }).indexOf(' ');
                let indexCharacter = this.blocks.map(function(e) { return e.rank; }).indexOf(rank);
                let checkAccessibility = false;

                if ((indexEmpty + 1)%4 === 0) {  // если справа
                    if (((indexEmpty - 4) === indexCharacter) || ((indexEmpty - 1) === indexCharacter) || ((indexEmpty + 4) === indexCharacter)) {
                        checkAccessibility = true
                    }

                } else if ((indexEmpty)%4 === 0) {  // если слева
                    if (((indexEmpty - 4) === indexCharacter) || ((indexEmpty + 1) === indexCharacter) || ((indexEmpty + 4) === indexCharacter)) {
                        checkAccessibility = true
                    }
                } else {
                    if (((indexEmpty - 4) === indexCharacter) || ((indexEmpty + 1) === indexCharacter) || ((indexEmpty - 1) === indexCharacter) || ((indexEmpty + 4) === indexCharacter)) {
                        checkAccessibility = true
                    }
                }


                if (checkAccessibility) {
                    this.shuffleCount++;
                    let elEmpty = this.blocks[indexEmpty];
                    let elCharacter = this.blocks[indexCharacter];

                    Vue.set(this.blocks, indexEmpty, elCharacter);
                    Vue.set(this.blocks, indexCharacter, elEmpty);
                }

                // checkWin
                let win = true;
                
                for (let i = 0; i < this.blocks.length; i++) {
                    if (this.blocks[i].id !== (i + 1)) {
                        win = false;
                        break;
                    }
                }

                if (win) {
                    this.winModal = true;
                    clearInterval(interval);
                    this.time = 0;
                }
            }

        },
        displayInitialDeck() {
            let id = 1;
            this.blocks = [];

            for( let r = 0; r < this.ranks.length; r++ ) {
                let card = {
                    id: id,
                    rank: this.ranks[r],
                };

                this.blocks.push(card);
                id++;
            }


            this.isDeckShuffled = false;
            this.shuffleCount = 0;
        },
        shuffleDeck() {
            this.shuffleCount = 0;

            if (!this.firstStart) {
                clearInterval(interval);
                this.time = 0;
            }
            let th = this;
            interval = setInterval(function () {
                th.time++;
            }, 1000);

            this.firstStart = false;

            for(let i = this.blocks.length - 1; i > 0; i--) {
                let randomIndex = Math.floor(Math.random() * i);

                let temp = this.blocks[i];
                Vue.set(this.blocks, i, this.blocks[randomIndex]);
                Vue.set(this.blocks, randomIndex, temp);
            }

            this.isDeckShuffled = true;
            this.winModal = false;
        },
    },
  }
</script>

<style lang="scss">
  @import "./styles_fonts";

  $font_Robotoslablight: Robotoslablight, 'Robotoslablight';
  $font_Robotoslabmedium: Robotoslabmedium, 'Robotoslabmedium';

  .fade-enter-active, .fade-leave-active {
    transition: opacity .5s;
  }
  .fade-enter, .fade-leave-to /* .fade-leave-active до версии 2.1.8 */ {
    opacity: 0;
  }

  html, body, #app {
    height: 100%;
    background: #f3f3f3;
    display: flex;
    flex-direction: column;
   align-items: center;
  }

  .title {
    font-family: $font_Robotoslablight, sans-serif;
    text-align: center;
    padding-top: 30px;
    margin-bottom: 0 !important;
    font-weight: 300;
    font-size: 3rem;
  }

  .vue-logo {
    height: 55px;
    position: relative;
    top: 10px;
  }

  .speed-buttons {
    text-align: center;
    padding-top: 30px;
  }
  .speed-buttons .button {
    height: 2.50em;
  }

  .main-buttons {
    margin: 30px auto 20px auto;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: $font_Robotoslablight, sans-serif;
    font-size: 20px;
    width: 120px;
    height: 36px;
    display: flex;
    text-align: center;
    border: 1px solid #737373;
    cursor: pointer;
    transition: 0.5s ease;
  }

  .main-buttons:hover {
    background-color: rgba(195, 195, 195, 0.1);
  }

  .count-section {
    font-family: $font_Robotoslablight, sans-serif;
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 18px;
  }

  .count-section-left {
    font-family: $font_Robotoslablight, sans-serif;
    position: absolute;
    top: 10px;
    left: 10px;
    font-size: 18px;
  }

  .fas {
    padding-left: 5px;
  }

  .deck {
    width: 400px;
    height: 400px;
    border: 1px solid #c3c3c3;
  }

  .blockWin {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 400px;
    border-right: 1px solid #737373;
    border-bottom: 1px solid #737373;
    border-left: 1px solid #737373;
    font-family: $font_Robotoslablight, sans-serif;
    transition: opacity .5s;
  }

  .block {
    width: 98px;
    height: 98px;
    float: left;
    font-size: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #737373;
    transition: 0.5s ease;
    background-color: white;
    font-family: $font_Robotoslablight, sans-serif;
  }

  .block:hover {
    background-color: #ebebeb;
    cursor: pointer;
  }

  .shuffleMedium-move {
    transition: transform 1s;
  }
  .fade-enter-active, .fade-leave-active {
    transition: opacity .5s;
  }

  .fade-enter, .fade-leave-to {
    opacity: 0;
  }

  @media (max-width: 1210px) {
    .deck {
      position: initial;
      top: 0;
    }
    
  }

</style>
