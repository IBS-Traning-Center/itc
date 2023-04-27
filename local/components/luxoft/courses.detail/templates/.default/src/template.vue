<template>
  <el-dialog
      :title="lang.title"
      :visible="showModal"
      :before-close="modalClose"
      :lock-scroll="false"
      :close-on-click-modal="false"
      class="course-detail-modal"
      width="90%">
    <el-form v-if="formStatus !== 'success'" :inline="true" ref="formData" class="demo-form-inline" label-position="top">
      <el-row :gutter="30"
        class="course-detail-modal__row course-detail-modal__row_select">
        <el-col :span="12" :xs="24">
          <el-form-item :label="lang.date">
            <el-select
                class="course-detail-modal__date"
                v-model="formData.scheduleId" placeholder="Select"
                @change="setScheduleDataFormData">
              <el-option
                v-for="scheduleItem in scheduleDates"
                :key="scheduleItem.id"
                :label="scheduleItem.label"
                :value="scheduleItem.value"
              >
              </el-option>
            </el-select>
          </el-form-item>
        </el-col>
      </el-row>
      <el-row :gutter="30">
        <el-col :span="8" :xs="24">
          <el-form-item
              :label="lang.name"
              :error="$v.formData.name.$error ? lang.errorName : ''"
              :class="{'is-error': $v.formData.name.$error}"
              required>
            <el-input v-model="formData.name"></el-input>
          </el-form-item>
        </el-col>
        <el-col :span="8" :xs="24">
          <el-form-item
              :label="lang.company"
              :error="$v.formData.company.$error ? lang.errorCompany : ''"
              :class="{'is-error': $v.formData.company.$error}">
            <el-input v-model="formData.company"></el-input>
          </el-form-item>
        </el-col>
        <el-col :span="8" :xs="24">
          <el-form-item
              :label="lang.position"
              :error="$v.formData.position.$error ? lang.errorPosition : ''"
              :class="{'is-error': $v.formData.position.$error}"
              required>
            <el-select
                filterable
                allow-create
                v-model="formData.position"
                class="course-detail-modal__date"
                placeholder="">
              <el-option
                  v-for="position in positions"
                  :key="position"
                  :label="position"
                  :value="position">
              </el-option>
            </el-select>
          </el-form-item>
        </el-col>
      </el-row>
      <el-row :gutter="30">
        <el-col :span="8" :xs="24">
          <el-form-item
              :label="lang.email"
              :error="$v.formData.email.$error ? lang.errorEmail : ''"
              :class="{'is-error': $v.formData.email.$error}" required>
            <el-input v-model="formData.email"></el-input>
          </el-form-item>
        </el-col>
        <el-col :span="8" :xs="24">
          <el-form-item
              :label="lang.phone"
              :error="$v.formData.phone.$error ? lang.errorPhone : ''"
              :class="{'is-error': $v.formData.phone.$error}"
              required>
            <el-input v-mask="checkPhone" v-model="formData.phone"></el-input>
          </el-form-item>
        </el-col>
        <el-col :span="8" :xs="24">
          <el-form-item
              :label="lang.city"
              :error="$v.formData.city.$error ? lang.errorCity : ''"
              :class="{'is-error': $v.formData.city.$error}"
          >
            <el-input v-model="formData.city"></el-input>
          </el-form-item>
        </el-col>
      </el-row>
      <el-row :gutter="30">
        <el-col :span="24" :xs="24">
          <el-form-item :label="lang.comment">
            <el-input
                :rows="4"
                type="textarea"
                v-model="formData.comment">
            </el-input>
          </el-form-item>
        </el-col>
      </el-row>
    </el-form>
    <el-form v-else>
      <el-row :gutter="30">
        <el-col :span="24" :xs="24"><div class="form-success__title">{{ lang.successTitle }}</div></el-col>
      </el-row>
      <el-row :gutter="30">
        <el-col :span="24" :xs="24"><div class="form-success__message">{{ lang.successMessage }}</div></el-col>
      </el-row>
    </el-form>
    <loader v-show="showLoader" />
    <span v-if="formStatus !== 'success'" slot="footer" class="dialog-footer">
      <el-row :gutter="30">
        <el-col class="course-detail-modal__agree" :span="16">
          <el-checkbox v-model="formData.agree_1" :class="{'is-error': $v.formData.agree_1.$error}" required><span v-html="lang.agree_1"></span></el-checkbox>
          <el-checkbox v-model="formData.agree_2" :class="{'is-error': $v.formData.agree_2.$error}" required><span v-html="lang.agree_2"></span></el-checkbox>
        </el-col>
        <el-col :span="8" class="course-detail-modal__submit">
          <el-button type="primary" @click="submit('formData')">{{ lang.register }}</el-button>
        </el-col>
      </el-row>
    </span>
  </el-dialog>
</template>
<script>
import {email, minLength, required} from 'vuelidate/dist/validators.min.js'
import store from '@/store/index.js'
import loader from '@/components/loader/default.vue'

export function checkPhone(value) {
  const result = value.replace(/[^+0-9]/g, '');
  return [...result]
}

export default {
  components: {
    loader
  },
  data: () => ({
    ...window.vueData.courseDetail,
    showLoader: false,
    formStatus: '',
    scheduleDates: [],
    formData: {
      customDate: '',
      scheduleId: 0,
      scheduleDateStart: '',
      scheduleDateEnd: '',
      scheduleTime: '',
      scheduleLocation: '',
      scheduleDuration: '',
      courseId: 0,
      courseCode: '',
      courseName: '',
      courseDetailUrl: '',
      name: '',
      company: '',
      position: '',
      email: '',
      phone: '',
      city: '',
      comment: '',
      agree_1: '',
      agree_2: '',
    },
    checkPhone,
  }),
  computed: {
    showModal() {
      const scheduleId = store.state.courseDetail.scheduleId
      this.$set(this.formData, 'scheduleId', scheduleId)

      return !!scheduleId
    },
    validationRules() {
      const self = this,
          rules = {
            formData: {
              name: {
                required,
                minLength: minLength(2)
              },
              company: {
                minLength: minLength(2)
              },
              position: {
                required,
              },
              city: {
                minLength: minLength(2)
              },
              phone: {
                required,
                minLength: minLength(10)
              },
              email: {
                required,
                email
              },
              agree_1: {
                required,
              },
              agree_2: {
                required,
              }
            }
          }
      return rules
    }
  },
  validations() {
    return this.validationRules
  },
  methods: {
    setScheduleDataFormData(select) {
      const self = this
      if(select === 'openDate') {
        self.$set(self.formData, 'scheduleDateStart', '')
        self.$set(self.formData, 'scheduleDateEnd', '')
        self.$set(self.formData, 'scheduleTime', '')
        self.$set(self.formData, 'scheduleLocation', '')
        self.$set(self.formData, 'scheduleDuration', '')
      } else {
        const scheduleItems = self.schedule.filter(function (item) {
          return select === item.id
        })
        self.$set(self.formData, 'scheduleDateStart', scheduleItems[0].date.start)
        self.$set(self.formData, 'scheduleDateEnd', scheduleItems[0].date.end)
        self.$set(self.formData, 'scheduleTime',     scheduleItems[0].time)
        self.$set(self.formData, 'scheduleLocation', scheduleItems[0].city)
        self.$set(self.formData, 'scheduleDuration', scheduleItems[0].duration)
      }
    },
    modalClose() {
      store.dispatch('courseDetail/setShowModal', false)
    },
    async submit() {
      const self = this
      self.$v.$touch()
      if (!self.$v.$invalid) {
        try {
          self.$set(self, 'showLoader', true);
          const response = await BX.ajax.runComponentAction(
              'luxoft:courses.detail',
              'formSave',
              {
                mode: 'class',
                data: self.formData
              }
          )
          self.$set(self, 'showLoader', false);
          self.$set(self, 'formStatus', 'success');
          self.sendAnalytics(response.data.resultId)
          self.formReset();
        } catch (response) {
          self.$set(self, 'showLoader', false);
          if (typeof response.errors !== 'undefined')
          {
            response.errors.forEach(function (error) {
              setTimeout(
                  function () {
                    self.$notify({
                      title: self.lang.titleError,
                      message: error.message,
                      type: 'error',
                      duration: 2000,
                    })
                  }, 250
              )
            })
          } else {
            self.$notify({
              title: self.lang.titleError,
              message: response,
              type: 'error'
            });
          }
        }
      } else {
        self.$notify({
          title: self.lang.titleError,
          message: self.lang.errorFields,
          type: 'error'
        });
      }
    },
    formReset() {
      this.$set(self, 'formData', {
        location: '',
        customDate: '',
        scheduleId: 0,
        scheduleDateStart: '',
        scheduleDateEnd: '',
        scheduleTime: '',
        scheduleLocation: '',
        scheduleDuration: '',
        courseId: 0,
        courseCode: '',
        courseName: '',
        courseDetailUrl: '',
        recommendations: [],
        name: '',
        company: '',
        position: '',
        email: '',
        phone: '',
        city: '',
        comment: '',
        agree_1: '',
        agree_2: '',
      })
    },
    formInit() {
      const self = this

      if(self.id) {
        self.$set(self.formData, 'courseId', self.id)
      }
      if(self.code) {
        self.$set(self.formData, 'courseCode', self.code)
      }
      if(self.name) {
        self.$set(self.formData, 'courseName', self.name)
      }
      if(self.detailUrl) {
        self.$set(self.formData, 'courseDetailUrl', self.detailUrl)
      }
      if(self.location) {
        self.$set(self.formData, 'location', self.location)
      }
      if(self.courses) {
        self.$set(self.formData, 'recommendations', self.courses)
      }


      if (self.schedule.length) {
        self.schedule.forEach(function(item) {
          self.scheduleDates.push({ id: item.id, label: item.formLabel, value: item.id })
        })
        self.$set(self.formData, 'scheduleId', self.schedule[0].id)

        if(self.scheduleId) {
          self.$set(self.formData, 'scheduleId', self.scheduleId)
          const scheduleItems = self.schedule.filter(function (item) {
            return self.scheduleId === item.id
          })
          self.$set(self.formData, 'scheduleDateStart', scheduleItems[0].date.start)
          self.$set(self.formData, 'scheduleDateEnd',   scheduleItems[0].date.end)

          self.$set(self.formData, 'scheduleTime',     scheduleItems[0].time)
          self.$set(self.formData, 'scheduleLocation', scheduleItems[0].city)
          self.$set(self.formData, 'scheduleDuration', scheduleItems[0].duration)
        }
      }

      self.scheduleDates.push({ id: 0, label: self.lang.openDate, value: 'openDate' })
    },
    sendAnalytics(resultId) {
      const self = this

      const scheduleItems = self.schedule.filter(function (item) {
        return self.formData.scheduleId === item.id
      })

      const transaction = {
            id: resultId,
            revenue: scheduleItems[0]['sale']['discountPrice'],
            currency: scheduleItems[0]['sale']['currency']
          },

          item = {
            id: resultId,
            name: scheduleItems[0]['code']+' '+scheduleItems[0]['name']+' '+scheduleItems[0]['city']+' '+scheduleItems[0]['date']['start'],
            sku: scheduleItems[0]['id'],
            quantity: '1',
            price: scheduleItems[0]['sale']['discountPrice'],
            currency: scheduleItems[0]['sale']['currency'],
          }

      if(self.formData.scheduleId === 'openDate') {
        window.targetEvents.noScheduleRegistration();
      } else {
        window.targetEvents.scheduleRegistration();
      }

      window.targetEvents.purchase(transaction, item);
    }
  },

  created() {
    this.formInit()
  }
}
</script>
<style lang="scss">
.course-detail-modal {
  overflow: hidden;

  &__row {
    position: relative;
    &_select {
      border-bottom: 1px solid #cccdd7;
      margin-bottom: 20px;
    }
  }

  &__date {
    width: 100% !important;
  }

  &__agree {
    height: 50px;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    justify-content: space-around;
  }

  .el-icon-close {
    &:before {
      font-size: 40px;
      line-height: 45px;
    }
  }

  .el-form-item {
    width: 100%;
    margin-right: 0;
    &__label {
      font-size: 14px;
      line-height: 1;
      padding-bottom: 6px;
    }
  }

  .el-form--inline {

  }

  .el-input {
    &__inner {
      border: 1px solid #cccdd7;
      border-radius: 4px;
      height: 40px;
    }
  }

  .el-select {
    width: 100%;
  }

  .el-dialog {
    max-width: 875px;
    border-radius: 10px;
    overflow: hidden;
    &__header {
      padding: 30px 30px 22px;
    }

    &__title {
      font-size: 30px;
      color: #262626;
    }

    &__body {
      padding: 0;
      .el-row {
        padding: 0 30px;
      }
    }

    &__footer {
      padding: 8px 30px 22px;

      .el-button {
        min-width: 210px;
        height: 50px;
        font-size: 20px;
        font-weight: bold;
      }
    }
  }

  .el-checkbox {
    &__label {
      text-align: left;
      white-space: initial;
      vertical-align: text-top;
    }
  }

  .el-checkbox.is-error .el-checkbox__inner {
    border-color: #f56c6c;
  }
  .form-success {
    &__title {
      font-size: 20px;
      font-weight: 600;
      margin-bottom: 15px;
    }
    &__message {
      font-size: 18px;
      font-weight: 400;
      margin-bottom: 40px;
    }
  }
}

@media (max-width: 889px) {
  .course-detail-modal {
    &__agree {
      width: 100%;
      height: auto;
      margin-bottom: 15px;
    }
    &__submit {
      justify-content: center;
      width: 100%;
    }

    .el-dialog {
      margin-top: 0!important;
      width: 100%!important;
      height: 100%;
      border-radius: 0;
      overflow-y: auto;
    }
    .dialog-footer .el-row {
      display: flex;
      flex-direction: column;
    }
  }
}
</style>