import React, { useEffect, useRef, useState } from 'react';
import { Search, X, ArrowRight, Wrench, Settings } from 'lucide-react';
import {
  PRODUCTS,
  SERVICES,
  type PageRoute,
  type ProductCategory,
  type ProductItem,
} from '../data/siteData';
import { searchCatalog } from '../utils/catalog';

interface SearchModalProps {
  isOpen: boolean;
  onClose: () => void;
  onSelectProduct: (product: ProductItem) => void;
  onNavigate: (page: PageRoute, category?: ProductCategory) => void;
}

const QUICK_TERMS = [
  'Altendorf F 45',
  'Edgebanding',
  'Sawmill',
  'Leitz',
  'Saw Blades',
  'Installation',
];

export const SearchModal: React.FC<SearchModalProps> = ({
  isOpen,
  onClose,
  onSelectProduct,
  onNavigate,
}) => {
  const [query, setQuery] = useState('');
  const inputRef = useRef<HTMLInputElement>(null);

  useEffect(() => {
    if (isOpen) {
      const t = window.setTimeout(() => inputRef.current?.focus(), 40);
      return () => window.clearTimeout(t);
    }
  }, [isOpen]);

  useEffect(() => {
    const onKeyDown = (e: KeyboardEvent) => {
      if ((e.metaKey || e.ctrlKey) && e.key.toLowerCase() === 'k') {
        e.preventDefault();
        if (isOpen) onClose();
      } else if (e.key === 'Escape' && isOpen) {
        onClose();
      }
    };
    window.addEventListener('keydown', onKeyDown);
    return () => window.removeEventListener('keydown', onKeyDown);
  }, [isOpen, onClose]);

  if (!isOpen) return null;

  const { products, services } = searchCatalog(PRODUCTS, SERVICES, query);
  const hasQuery = query.trim().length > 0;
  const totalMatches = products.length + services.length;

  return (
    <div
      role="dialog"
      aria-modal="true"
      aria-label="Search Serendib machinery and services"
      className="fixed inset-0 z-50 bg-slate-950/60 backdrop-blur-xs flex items-start justify-center pt-16 sm:pt-24 px-4"
      onClick={onClose}
    >
      <div
        className="w-full max-w-2xl bg-white rounded-2xl shadow-2xl border border-slate-200 overflow-hidden"
        onClick={(e) => e.stopPropagation()}
      >
        {/* Search Input Row */}
        <div className="flex items-center gap-3 px-4 sm:px-5 py-3.5 border-b border-slate-200">
          <Search className="w-5 h-5 text-[#1E2C7A] shrink-0" aria-hidden="true" />
          <label htmlFor="global-catalog-search" className="sr-only">
            Search machinery, tools, brands, or services
          </label>
          <input
            id="global-catalog-search"
            ref={inputRef}
            type="text"
            value={query}
            onChange={(e) => setQuery(e.target.value)}
            placeholder="Search Altendorf, Leitz, Wood-Mizer, sawmills, blades, services..."
            className="flex-1 text-sm sm:text-base text-slate-900 placeholder:text-slate-400 focus:outline-none"
          />
          {query && (
            <button
              type="button"
              onClick={() => setQuery('')}
              aria-label="Clear search query"
              className="p-1 text-slate-400 hover:text-slate-700 rounded cursor-pointer"
            >
              <X className="w-4 h-4" aria-hidden="true" />
            </button>
          )}
          <button
            type="button"
            onClick={onClose}
            aria-label="Close search"
            className="px-2.5 py-1 text-xs font-medium text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-md cursor-pointer"
          >
            Esc
          </button>
        </div>

        {/* Results Panel */}
        <div className="max-h-[60vh] overflow-y-auto p-4 sm:p-5">
          {!hasQuery ? (
            <div>
              <p className="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">
                Popular Searches
              </p>
              <div className="flex flex-wrap gap-2">
                {QUICK_TERMS.map((term) => (
                  <button
                    key={term}
                    type="button"
                    onClick={() => setQuery(term)}
                    className="px-3 py-1.5 text-xs font-medium text-[#1E2C7A] bg-slate-100 hover:bg-[#1E2C7A] hover:text-white rounded-lg transition-colors cursor-pointer"
                  >
                    {term}
                  </button>
                ))}
              </div>
            </div>
          ) : totalMatches === 0 ? (
            <div className="py-10 text-center">
              <p className="text-sm font-semibold text-slate-900 mb-1">
                No matching machinery or services found
              </p>
              <p className="text-xs text-slate-500 mb-4">
                Try searching by brand (Altendorf, Leitz, Wood-Mizer) or category.
              </p>
              <button
                type="button"
                onClick={() => {
                  onClose();
                  onNavigate('products');
                }}
                className="px-4 py-2 text-xs font-semibold text-white bg-[#1E2C7A] rounded-lg cursor-pointer"
              >
                Browse Full Catalog
              </button>
            </div>
          ) : (
            <div className="space-y-5">
              {products.length > 0 && (
                <div>
                  <div className="flex items-center justify-between mb-2">
                    <p className="text-xs font-semibold text-slate-500 uppercase tracking-wider">
                      Machinery &amp; Tools ({products.length})
                    </p>
                    <button
                      type="button"
                      onClick={() => {
                        onClose();
                        onNavigate('products');
                      }}
                      className="text-xs font-semibold text-[#1E2C7A] hover:underline cursor-pointer"
                    >
                      View Products Page
                    </button>
                  </div>
                  <div className="divide-y divide-slate-100 border border-slate-200 rounded-xl overflow-hidden">
                    {products.slice(0, 8).map((item) => (
                      <button
                        key={item.id}
                        type="button"
                        onClick={() => {
                          onClose();
                          onSelectProduct(item);
                        }}
                        className="w-full flex items-center gap-3.5 p-3 text-left hover:bg-slate-50 transition-colors cursor-pointer"
                      >
                        <div className="w-14 h-11 rounded-lg bg-slate-100 border border-slate-200 shrink-0 overflow-hidden flex items-center justify-center p-1">
                          <img
                            src={item.image}
                            alt={item.name}
                            referrerPolicy="no-referrer"
                            className="w-full h-full object-contain"
                          />
                        </div>
                        <div className="min-w-0 flex-1">
                          <p className="text-sm font-semibold text-slate-900 truncate">
                            {item.name}
                          </p>
                          <p className="text-xs text-slate-500 truncate">
                            {item.brand} · {item.subcategory ?? item.category}
                          </p>
                        </div>
                        <ArrowRight
                          className="w-4 h-4 text-slate-400 shrink-0"
                          aria-hidden="true"
                        />
                      </button>
                    ))}
                  </div>
                </div>
              )}

              {services.length > 0 && (
                <div>
                  <p className="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">
                    Services ({services.length})
                  </p>
                  <div className="divide-y divide-slate-100 border border-slate-200 rounded-xl overflow-hidden">
                    {services.map((svc) => (
                      <button
                        key={svc.id}
                        type="button"
                        onClick={() => {
                          onClose();
                          onNavigate('services');
                        }}
                        className="w-full flex items-center gap-3 p-3 text-left hover:bg-slate-50 transition-colors cursor-pointer"
                      >
                        <div className="w-9 h-9 rounded-lg bg-[#1E2C7A]/10 text-[#1E2C7A] flex items-center justify-center shrink-0">
                          <Settings className="w-4 h-4" aria-hidden="true" />
                        </div>
                        <div className="min-w-0 flex-1">
                          <p className="text-sm font-semibold text-slate-900">
                            {svc.title}
                          </p>
                          <p className="text-xs text-slate-500 truncate">
                            {svc.capabilities.join(' · ')}
                          </p>
                        </div>
                        <Wrench
                          className="w-4 h-4 text-slate-400 shrink-0"
                          aria-hidden="true"
                        />
                      </button>
                    ))}
                  </div>
                </div>
              )}
            </div>
          )}
        </div>
      </div>
    </div>
  );
};
