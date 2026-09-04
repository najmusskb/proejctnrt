import { createRouter, createWebHistory } from 'vue-router';

import HomeView from '../views/HomeView.vue';
import AboutView from '../views/AboutView.vue';
import ToursView from '../views/ToursView.vue';
import TicketsView from '../views/TicketsView.vue';
import DestinationsView from '../views/DestinationsView.vue';
import DestinationToursView from '../views/DestinationToursView.vue';
import CategoryToursView from '../views/CategoryToursView.vue';
import TourDetailView from '../views/TourDetailView.vue';
import CartView from '../views/CartView.vue';
import CheckoutView from '../views/CheckoutView.vue';
import ServicesView from '../views/ServicesView.vue';
import ServiceDetailView from '../views/ServiceDetailView.vue';
import BlogIndexView from '../views/BlogIndexView.vue';
import BlogDetailView from '../views/BlogDetailView.vue';
import GalleryView from '../views/GalleryView.vue';
import ContactView from '../views/ContactView.vue';

const routes = [
  { path: '/', name: 'home', component: HomeView, meta: { title: 'Home' } },
  { path: '/about', name: 'about', component: AboutView, meta: { title: 'About Us' } },
  { path: '/tours', name: 'tours', component: ToursView, meta: { title: 'All Tours' } },
  { path: '/tickets', name: 'tickets', component: TicketsView, meta: { title: 'Tickets & Passes' } },
  { path: '/all-destinations', name: 'destinations', component: DestinationsView, meta: { title: 'Destinations' } },
  { path: '/destination/:slug', name: 'destination.detail', component: DestinationToursView, meta: { title: 'Destination Tours' } },
  { path: '/category/:slug', name: 'category.detail', component: CategoryToursView, meta: { title: 'Category Tours' } },
  { path: '/tour/:slug', name: 'tour.detail', component: TourDetailView, meta: { title: 'Tour Detail' } },
  { path: '/cart', name: 'cart', component: CartView, meta: { title: 'Your Cart' } },
  { path: '/checkout', name: 'checkout', component: CheckoutView, meta: { title: 'Checkout' } },
  { path: '/our-services', name: 'services', component: ServicesView, meta: { title: 'Our Services' } },
  { path: '/services', redirect: '/our-services' },
  { path: '/service/:slug', name: 'service.detail', component: ServiceDetailView, meta: { title: 'Service Detail' } },
  { path: '/blogs', name: 'blogs', component: BlogIndexView, meta: { title: 'Blog & Travel Guides' } },
  { path: '/blog/:slug', name: 'blog.detail', component: BlogDetailView, meta: { title: 'Blog Article' } },
  { path: '/photo-gallery', name: 'gallery', component: GalleryView, meta: { title: 'Photo Gallery' } },
  { path: '/contact-us', name: 'contact', component: ContactView, meta: { title: 'Contact Us' } },
  { path: '/:pathMatch(.*)*', redirect: '/' },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
  scrollBehavior(to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition;
    } else if (to.hash) {
      return { el: to.hash, behavior: 'smooth' };
    } else {
      return { top: 0, behavior: 'smooth' };
    }
  },
});

router.afterEach((to) => {
  const companyName = window.__NIRT__?.company?.com_name || 'Journey With Mr. J';
  document.title = `${to.meta.title || 'Rome Tours'} — ${companyName}`;
});

export default router;
