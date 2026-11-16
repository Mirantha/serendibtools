import type {
  ProductCategory,
  ProductItem,
  SawmillSubcategory,
  ServiceItem,
} from '../data/siteData';

export interface ProductFilterOptions {
  category?: ProductCategory | 'All';
  subcategory?: SawmillSubcategory | 'All';
  brand?: ProductItem['brand'] | 'All';
  query?: string;
}

export function filterProducts(
  products: ProductItem[],
  options: ProductFilterOptions
): ProductItem[] {
  const {
    category = 'All',
    subcategory = 'All',
    brand = 'All',
    query = '',
  } = options;
  const normalizedQuery = query.trim().toLowerCase();

  return products.filter((item) => {
    if (category !== 'All' && item.category !== category) {
      return false;
    }
    if (
      category === 'Sawmills' &&
      subcategory !== 'All' &&
      item.subcategory !== subcategory
    ) {
      return false;
    }
    if (brand !== 'All' && item.brand !== brand) {
      return false;
    }
    if (!normalizedQuery) {
      return true;
    }

    const haystack = [
      item.name,
      item.brand,
      item.category,
      item.subcategory ?? '',
      item.tagline ?? '',
      item.description,
      ...item.highlights,
    ]
      .join(' ')
      .toLowerCase();

    return haystack.includes(normalizedQuery);
  });
}

export interface GlobalSearchResults {
  products: ProductItem[];
  services: ServiceItem[];
}

export function searchCatalog(
  products: ProductItem[],
  services: ServiceItem[],
  query: string
): GlobalSearchResults {
  const q = query.trim().toLowerCase();
  if (!q) {
    return { products: [], services: [] };
  }

  const matchedProducts = filterProducts(products, { query: q });
  const matchedServices = services.filter((svc) => {
    const haystack = [svc.title, svc.description, ...svc.capabilities]
      .join(' ')
      .toLowerCase();
    return haystack.includes(q);
  });

  return {
    products: matchedProducts,
    services: matchedServices,
  };
}

export interface QuoteFormInput {
  fullName: string;
  phone: string;
  email: string;
  serviceRequired: string;
  message: string;
}

export interface QuoteFormErrors {
  fullName?: string;
  phone?: string;
  email?: string;
  serviceRequired?: string;
}

export function validateQuoteForm(input: QuoteFormInput): QuoteFormErrors {
  const errors: QuoteFormErrors = {};

  if (!input.fullName.trim() || input.fullName.trim().length < 2) {
    errors.fullName = 'Please enter your full name.';
  }

  const digits = input.phone.replace(/[^\d+]/g, '');
  if (!digits || digits.replace(/\+/g, '').length < 9) {
    errors.phone = 'Please enter a valid contact phone number.';
  }

  if (input.email.trim()) {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(input.email.trim())) {
      errors.email = 'Please enter a valid email address.';
    }
  }

  if (!input.serviceRequired.trim()) {
    errors.serviceRequired = 'Please select a required service or machinery category.';
  }

  return errors;
}

export function buildWhatsAppUrl(
  whatsappNumber: string,
  message: string
): string {
  const cleanNumber = whatsappNumber.replace(/\D/g, '');
  const text = encodeURIComponent(message.trim());
  return `https://wa.me/${cleanNumber}${text ? `?text=${text}` : ''}`;
}
