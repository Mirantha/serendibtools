import { useEffect, useState } from 'react';
import {
  type PageRoute,
  type ProductCategory,
  type ProductItem,
} from './data/siteData';
import { Navbar } from './components/Navbar';
import { Footer } from './components/Footer';
import { SearchModal } from './components/SearchModal';
import { ProductModal } from './components/ProductModal';
import { WhatsAppWidget } from './components/WhatsAppWidget';
import { HomePage } from './pages/HomePage';
import { AboutPage } from './pages/AboutPage';
import { ProductsPage } from './pages/ProductsPage';
import { ServicesPage } from './pages/ServicesPage';
import { ContactPage } from './pages/ContactPage';

function resolveRouteFromPath(pathname: string): PageRoute {
  const clean = pathname.replace(/\/+$/, '').toLowerCase();
  if (clean.endsWith('/about')) return 'about';
  if (clean.endsWith('/products')) return 'products';
  if (clean.endsWith('/services')) return 'services';
  if (clean.endsWith('/contact')) return 'contact';
  return 'home';
}

export default function App() {
  const [currentPage, setCurrentPage] = useState<PageRoute>(() =>
    resolveRouteFromPath(window.location.pathname)
  );
  const [selectedCategory, setSelectedCategory] = useState<
    ProductCategory | 'All'
  >('All');
  const [searchOpen, setSearchOpen] = useState(false);
  const [activeProduct, setActiveProduct] = useState<ProductItem | null>(null);
  const [prefillService, setPrefillService] = useState('');
  const [prefillMessage, setPrefillMessage] = useState('');
  const [mapsQuotaExceeded, setMapsQuotaExceeded] = useState(false);

  useEffect(() => {
    const onQuotaExceeded = () => setMapsQuotaExceeded(true);
    window.addEventListener('gmp-quota-exceeded', onQuotaExceeded);
    return () =>
      window.removeEventListener('gmp-quota-exceeded', onQuotaExceeded);
  }, []);

  useEffect(() => {
    const onPopState = () => {
      setCurrentPage(resolveRouteFromPath(window.location.pathname));
    };
    window.addEventListener('popstate', onPopState);
    return () => window.removeEventListener('popstate', onPopState);
  }, []);

  const navigate = (page: PageRoute, category?: ProductCategory) => {
    setCurrentPage(page);
    if (category) {
      setSelectedCategory(category);
    } else if (page === 'products' && !category) {
      // Keep current category unless explicitly navigating elsewhere
    }
    const targetPath = page === 'home' ? '/' : `/${page}`;
    if (window.location.pathname !== targetPath) {
      window.history.pushState({}, '', targetPath);
    }
    window.scrollTo({ top: 0, behavior: 'smooth' });
  };

  const handleInquireProduct = (product: ProductItem) => {
    const mappedService =
      product.category === 'Sawmills' ||
      product.category === 'Sliding Table Saws' ||
      product.category === 'Edgebanding Machines'
        ? 'Wood & Log Sawing Machines'
        : 'Furniture & Industrial Tools';
    setPrefillService(mappedService);
    setPrefillMessage(
      `I would like a quotation and availability details for ${product.name} (${product.brand}).`
    );
    navigate('contact');
  };

  const handleInquireService = (serviceTitle: string) => {
    const matchMap: Record<string, string> = {
      'Wood & Log Sawing Machines': 'Wood & Log Sawing Machines',
      'Furniture & Industrial Tools Supply': 'Furniture & Industrial Tools',
      'Machinery Installation & Technical Support': 'Machinery Installation',
      'Interior & Machinery Setup Solutions': 'Interior & Factory Setup',
      'UPVC, Aluminium & Metal Machining': 'UPVC / Aluminium / Metal',
      'After-Sales Service & Maintenance': 'After-Sales Maintenance',
    };
    setPrefillService(matchMap[serviceTitle] ?? 'Other Enquiry');
    setPrefillMessage(`Enquiry regarding: ${serviceTitle}.`);
    navigate('contact');
  };

  return (
    <div className="min-h-screen flex flex-col bg-white text-slate-900">
      {mapsQuotaExceeded && (
        <div className="bg-amber-50 border-b border-amber-200 text-amber-900 px-4 py-2.5 text-xs md:text-sm text-center sticky top-0 z-50 shadow-sm">
          <span>
            Google Maps Platform quota reached. If you are the app owner, visit{' '}
            <a
              href="https://developers.google.com/maps/ai/ai-studio?utm_campaign=gmp_mcp_codeassist_v1_aistudio#quota_exceeded_errors"
              target="_blank"
              rel="noopener noreferrer"
              className="underline font-semibold text-amber-950 hover:text-amber-800"
            >
              maps developer site
            </a>{' '}
            for instructions to update your account.
          </span>
        </div>
      )}

      <Navbar
        currentPage={currentPage}
        onNavigate={(page) => navigate(page)}
        onOpenSearch={() => setSearchOpen(true)}
      />

      <main id="primary" className="flex-1">
        {currentPage === 'home' && (
          <HomePage
            onNavigate={navigate}
            onSelectProduct={setActiveProduct}
            onInquireProduct={handleInquireProduct}
          />
        )}

        {currentPage === 'about' && (
          <AboutPage onNavigate={(page) => navigate(page)} />
        )}

        {currentPage === 'products' && (
          <ProductsPage
            selectedCategory={selectedCategory}
            onChangeCategory={setSelectedCategory}
            onNavigate={(page) => navigate(page)}
            onSelectProduct={setActiveProduct}
            onInquireProduct={handleInquireProduct}
          />
        )}

        {currentPage === 'services' && (
          <ServicesPage
            onNavigate={navigate}
            onInquireService={handleInquireService}
          />
        )}

        {currentPage === 'contact' && (
          <ContactPage
            prefillService={prefillService}
            prefillMessage={prefillMessage}
            onNavigate={(page) => navigate(page)}
          />
        )}
      </main>

      <Footer onNavigate={navigate} />

      <SearchModal
        isOpen={searchOpen}
        onClose={() => setSearchOpen(false)}
        onSelectProduct={setActiveProduct}
        onNavigate={navigate}
      />

      <ProductModal
        product={activeProduct}
        onClose={() => setActiveProduct(null)}
        onRequestQuote={handleInquireProduct}
      />

      <WhatsAppWidget />
    </div>
  );
}
