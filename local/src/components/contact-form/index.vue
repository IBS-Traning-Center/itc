<template>
  <div>

    <form class="contact-form">
      <div class="contact-form__header">
        <div class="contact-form__headline">
          Contact form
        </div>
        <span>Поля отмеченные * обязательны к заполнению.</span>
      </div>
      <div class="form-structure-new contact-form__structure">
        <div class="form-structure-new__row">
          <div class="form-structure-new__column contact-form__gender-picker form-structure-new__column--size_100">
            <div class="base-options">
              <div class="base-options__options">
                <div class="base-radio base-options__option">
                  <input id="radioMrs" type="radio" name="salutation" class="base-radio__input" value="MS">
                  <label for="radioMrs" class="base-radio__label">
                    <div class="base-radio__content">
                      <div class="base-radio__circle base-radio__circle--checked"></div>
                      <div class="base-radio__text">Mrs</div>
                    </div>
                  </label>
                </div>
                <div class="base-radio base-options__option">
                  <input id="radioMr" type="radio" name="salutation" class="base-radio__input" value="MR">
                  <label for="radioMr" class="base-radio__label">
                    <div class="base-radio__content">
                      <div class="base-radio__circle"></div>
                      <div class="base-radio__text">Mr</div>
                    </div>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-structure-new__column form-structure-new__column--size_100">
            <div class="base-input base-input--labeled">
              <div class="base-input__container">
                <div class="base-input__field">
                  <input autocomplete="nope" name="title" class="base-input__input">
                  <label class="base-input__label">Degree</label>
                </div>
                <div class="base-input__icon base-input__icon--right"></div>
              </div>
              <div class="base-error" style="display: none;"></div>
            </div>
          </div>
        </div>
        <div class="form-structure-new__row">
          <div class="form-structure-new__column form-structure-new__column--size_100">
            <div class="base-input base-input--labeled">
              <div class="base-input__container">
                <div class="base-input__field">
                  <input autocomplete="nope" name="firstname" class="base-input__input">
                  <label class="base-input__label base-input__label--required">Имя</label>
                </div>
                <div class="base-input__icon base-input__icon--right"></div>
              </div>
              <div class="base-error" style="display: none;"></div>
            </div>
          </div>
          <div class="form-structure-new__column form-structure-new__column--size_100">
            <div class="base-input base-input--labeled">
              <div class="base-input__container">
                <div class="base-input__field">
                  <input autocomplete="nope" name="lastname" class="base-input__input">
                  <label class="base-input__label base-input__label--required">Фамилия</label>
                </div>
                <div class="base-input__icon base-input__icon--right"></div>
              </div>
              <div class="base-error" style="display: none;"></div>
            </div>
          </div>
        </div>
        <div class="form-structure-new__row">
          <div class="form-structure-new__column form-structure-new__column--size_100">
            <div class="base-input base-input--labeled">
              <div class="base-input__container">
                <div class="base-input__field">
                  <input autocomplete="nope" name="email" class="base-input__input">
                  <label class="base-input__label base-input__label--required">E-mail</label>
                </div>
                <div class="base-input__icon base-input__icon--right"></div>
              </div>
              <div class="base-error" style="display: none;"></div>
            </div>
          </div>
          <div class="form-structure-new__column form-structure-new__column--size_100">
            <div class="base-input base-input--labeled">
              <div class="base-input__container">
                <div class="base-input__field">
                  <input autocomplete="nope" name="orderNumber" class="base-input__input">
                  <label class="base-input__label">Order- or invoice number</label>
                </div>
                <div class="base-input__icon base-input__icon--right"></div>
              </div>
              <div class="base-error" style="display: none;"></div>
            </div>
          </div>
        </div>
        <div class="form-structure-new__row">
          <div class="form-structure-new__column form-structure-new__column--size_100">
            <div class="base-select">
              <input id="selectSubject" type="hidden" name="subject" autocomplete="">
              <div tabindex="0" class="base-select__container">
                <div class="base-select__content">
                  <span class="base-select__label base-select__label--required">{{currentSubject.name}}</span>
                  <span class="base-select__icons">
                    <div class="icon base-select__arrow icon--arrowDownLight"></div>
                  </span>
                </div>
                <div class="base-select__options" style="display: none;">
                  <div v-for="(item, index) in subjects" :key="index" class="base-select__option" v-on:click="choiceSubject(index)">{{item.name}}</div>
                </div>
                <select autocomplete="" class="base-select__select-native">
                  <option v-for="(item, index) in subjects" :key="index" :value="item.value" v-on:change="choiceSubject(index)">{{item.name}}</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="form-structure-new__row">
          <div class="form-structure-new__column form-structure-new__column--size_100">
            <div class="base-textarea">
              <div class="base-textarea__container">
                <div class="base-textarea__field">
                  <textarea name="content" class="base-textarea__input"></textarea>
                  <label class="base-textarea__label base-textarea__label--required">
                    Сообщение
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="contact-form__buttons">
        <button type="button" class="contact-form__button button">
          Reset
        </button>
        <button type="submit" class="contact-form__button contact-form__button--cta button button--black">
          Отправить
        </button>
      </div>
    </form>

  </div>
</template>

<script>
export default {
  name: "contactForm",
  data(){
    return {
      test: "Test2",
      currentSubject: {
        name: 'Выберите тему вопроса',
        value: null
      },
      subjects: [
        {
          name: 'Subscription',
          value: 'abonnement'
        },
        {
          name: 'Order',
          value: 'bestellung'
        },
        {
          name: 'Data protection',
          value: 'datenschutz'
        },
        {
          name: 'Questions about voucher',
          value: 'geschenkgutschein'
        },
        {
          name: 'Delivery date / Delivery request',
          value: 'liefertermin'
        },
        {
          name: 'Newsletter',
          value: 'newsletter'
        },
        {
          name: 'Personalization / Embroidery',
          value: 'personalisierung'
        },
        {
          name: 'Product information',
          value: 'produktinformation'
        },
        {
          name: 'Returns / Exchange',
          value: 'returnsexchange'
        },
        {
          name: 'Miscellaneous',
          value: 'miscellaneous'
        },
        {
          name: 'Payment',
          value: 'payment'
        }
      ]
    }
  },
  methods:{
    choiceSubject(index) {
      this.currentSubject = this.subjects[index];
      console.log(23);
    }
  }

}
</script>

<style scoped>

</style>
