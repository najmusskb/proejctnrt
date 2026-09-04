<template>
  <div class="contact-page">
    <!-- Hero Section -->
    <section class="contact-hero">
      <div class="contact-hero-content">
        <h1 class="contact-hero-title">Contact Us</h1>
      </div>
    </section>

    <!-- Contact Area -->
    <section class="contact-container">
      <div class="contact-wrapper">
        
        <!-- Left Side: Info -->
        <div class="contact-details">
          <h2 class="contact-heading">Get In Touch !!</h2>
          
          <div class="contact-info-item">
            <span class="contact-info-label">Call Us</span>
            <div class="contact-info-text">{{ company?.phone || '+39 06 1234 5678' }}</div>
          </div>
          
          <div class="contact-info-item">
            <span class="contact-info-label">Email Address</span>
            <div class="contact-info-text">{{ company?.email || 'info@journeywithmrj.com' }}</div>
          </div>
          
          <div class="contact-info-item">
            <span class="contact-info-label">Location</span>
            <div class="contact-info-text">{{ company?.address || 'Rome, Italy' }}</div>
          </div>
          
          <div class="contact-socials">
            <a v-if="company?.facebook" :href="company.facebook" target="_blank">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
            </a>
            <a v-if="company?.instagram" :href="company.instagram" target="_blank">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
            </a>
            <a v-if="company?.youtube" :href="company.youtube" target="_blank">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33 2.78 2.78 0 0 0 1.94 2c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.33 29 29 0 0 0-.46-5.33z"></path><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon></svg>
            </a>
          </div>
        </div>

        <!-- Right Side: Form -->
        <div class="contact-form-box">
          <div v-if="successMessage" class="alert-success">
            {{ successMessage }}
          </div>

          <div v-if="errorMessage" class="bg-red-100 text-red-700 p-4 rounded-md mb-6 font-semibold">
            {{ errorMessage }}
          </div>

          <form @submit.prevent="handleSubmit">
            <div class="form-grid">
              <div class="form-group">
                <label class="form-label">Full Name *</label>
                <input type="text" v-model="form.name" class="form-control" placeholder="John Doe" required>
              </div>
              
              <div class="form-group">
                <label class="form-label">Email Address *</label>
                <input type="email" v-model="form.email" class="form-control" placeholder="john@example.com" required>
              </div>
              
              <div class="form-group">
                <label class="form-label">Phone Number *</label>
                <input type="text" v-model="form.phone" class="form-control" placeholder="+1 234 567 8900" required>
              </div>
              
              <div class="form-group">
                <label class="form-label">Subject (Optional)</label>
                <input type="text" v-model="form.subject" class="form-control" placeholder="Inquiry about Vatican Tour">
              </div>
              
              <div class="form-group full-width">
                <label class="form-label">Message *</label>
                <textarea v-model="form.message" class="form-control" placeholder="How can we help you?" required></textarea>
              </div>
              
              <div class="form-group full-width">
                <button type="submit" class="btn-submit" :disabled="submitting">
                  {{ submitting ? 'Sending...' : 'Send Message' }}
                </button>
              </div>
            </div>
          </form>
        </div>
        
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { useAppStore } from '../stores/app';

const appStore = useAppStore();
const company = computed(() => appStore.company);

const form = ref({
  name: '',
  email: '',
  phone: '',
  subject: '',
  message: '',
});

const submitting = ref(false);
const successMessage = ref('');
const errorMessage = ref('');

const handleSubmit = async () => {
  submitting.value = true;
  successMessage.value = '';
  errorMessage.value = '';

  try {
    const res = await fetch('/api/contact', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
      },
      body: JSON.stringify(form.value),
    });

    const data = await res.json();
    if (res.ok && data.success) {
      successMessage.value = data.message || 'Your message has been sent successfully! Our team will contact you soon.';
      form.value = {
        name: '',
        email: '',
        phone: '',
        subject: '',
        message: '',
      };
    } else {
      errorMessage.value = data.message || 'There was an error sending your message. Please check the fields and try again.';
    }
  } catch (e) {
    console.error('Contact form submission error', e);
    errorMessage.value = 'Network error. Please try again or reach us on WhatsApp.';
  } finally {
    submitting.value = false;
  }
};
</script>

<style scoped>
.contact-hero {
    position: relative;
    width: 100%;
    height: 420px;
    background-image: url('/uploads/slider/Rome_6a9132df7e458.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    padding: 0 5%;
}
.contact-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to right, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.4) 100%);
    z-index: 1;
}
.contact-hero-content {
    position: relative;
    z-index: 2;
    max-width: 600px;
}
.contact-hero-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 56px;
    font-weight: 700;
    color: #fff;
    margin-bottom: 12px;
    line-height: 1.1;
}
.contact-container {
    padding: 60px 5%;
    background: #fcfcfc;
    display: flex;
    justify-content: center;
}
.contact-wrapper {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.03);
    display: grid;
    grid-template-columns: 1fr;
    max-width: 1100px;
    width: 100%;
    overflow: hidden;
}
@media (min-width: 768px) {
    .contact-wrapper {
        grid-template-columns: 1fr 1.5fr;
    }
}
.contact-details {
    background: #f9fafb;
    padding: 40px;
    border-right: 1px solid #e5e7eb;
}
.contact-heading {
    font-family: 'Cormorant Garamond', serif;
    font-size: 32px;
    font-weight: 700;
    color: #111827;
    margin-bottom: 24px;
}
.contact-info-item {
    margin-bottom: 24px;
}
.contact-info-label {
    font-size: 13px;
    font-weight: 700;
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 8px;
    display: block;
}
.contact-info-text {
    font-size: 16px;
    font-weight: 600;
    color: #1f2937;
    line-height: 1.5;
}
.contact-socials {
    display: flex;
    gap: 12px;
    margin-top: 32px;
}
.contact-socials a {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 50%;
    color: #4b5563;
    transition: all 0.3s;
}
.contact-socials a:hover {
    background: #c8a84e;
    color: #fff;
    border-color: #c8a84e;
}
.contact-form-box {
    padding: 40px;
    background: #fff;
}
.form-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 20px;
}
@media (min-width: 640px) {
    .form-grid {
        grid-template-columns: 1fr 1fr;
    }
}
.form-group {
    display: flex;
    flex-direction: column;
}
.form-group.full-width {
    grid-column: 1 / -1;
}
.form-label {
    font-size: 14px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 8px;
}
.form-control {
    border: 1px solid #d1d5db;
    border-radius: 6px;
    padding: 12px 16px;
    font-size: 15px;
    color: #1f2937;
    transition: border-color 0.2s, box-shadow 0.2s;
    background: #f9fafb;
}
.form-control:focus {
    outline: none;
    border-color: #c8a84e;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(200,168,78,0.1);
}
textarea.form-control {
    resize: vertical;
    min-height: 120px;
}
.btn-submit {
    background: #0b1623;
    color: #fff;
    font-size: 14px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 14px 28px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background 0.3s;
    width: 100%;
    margin-top: 10px;
}
.btn-submit:hover {
    background: #c8a84e;
    color: #0b1623;
}
.alert-success {
    background: #d1fae5;
    color: #065f46;
    padding: 16px;
    border-radius: 6px;
    margin-bottom: 24px;
    font-weight: 600;
}
@media (max-width: 768px) {
    .contact-hero { height: 320px; background-attachment: scroll; }
    .contact-hero-title { font-size: 40px; }
    .contact-container { padding: 40px 5%; }
    .contact-details { padding: 28px; }
    .contact-form-box { padding: 28px; }
}
@media (max-width: 480px) {
    .contact-hero { height: 260px; padding: 0 4%; }
    .contact-hero-title { font-size: 30px; }
    .contact-container { padding: 28px 4%; }
    .contact-details { padding: 20px; }
    .contact-heading { font-size: 26px; margin-bottom: 18px; }
    .contact-form-box { padding: 20px; }
    .form-grid { gap: 14px; }
    .form-control { padding: 10px 14px; font-size: 14px; }
    .contact-info-item { margin-bottom: 18px; }
    .contact-socials { margin-top: 24px; }
}
</style>
