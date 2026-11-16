import React, { useState } from 'react';
import { Search, X } from 'lucide-react';
import {
  PRODUCTS,
  PRODUCT_CATEGORIES,
  SAWMILL_SUBCATEGORIES,
  type PageRoute,
  type ProductCategory,
  type ProductItem,
  type SawmillSubcategory,
} from '../data/siteData';
import { MEDIA_ASSETS } from '../data/mediaAssets';
import { filterProducts } from '../utils/catalog';
import { PageHeader } from '../components/PageHeader';
import { ProductCard } from '../components/ProductCard';
import { TrustBar, WhySerendibSection } from '../components/WhySerendibSection';

interface ProductsPageProps {
  selectedCategory: ProductCategory | 'All';
  onChangeCategory: (category: ProductCategory | 'All') => void;
  onNavigate: (page: PageRoute) => void;
  onSelectProduct: (product: ProductItem) => void;
  onInquireProduct: (product: ProductItem) => void;
}

const BRANDS: Array<ProductItem['brand'] | 'All'> = [
  'All',
  'Altendorf',
  'Leitz',
  'Wood-Mizer',
];

export const ProductsPage: React.FC<ProductsPageProps> = ({
  selectedCategory,
  onChangeCategory,
  onNavigate,
  onSelectProduct,
  onInquireProduct,
}) => {
  const [searchQuery, setSearchQuery] = useState('');
  const [selectedBrand, setSelectedBrand] = useState<
    ProductItem['brand'] | 'All'
  >('All');
  const [sawmillSub, setSawmillSub] = useState<SawmillSubcategory | 'All'>(
    'All'
  );

  const filteredProducts = filterProducts(PRODUCTS, {
    category: selectedCategory,
    subcategory: sawmillSub,
    brand: selectedBrand,
    query: searchQuery,
  });

  const handleCategorySelect = (cat: ProductCategory | 'All') => {
    onChangeCategory(cat);
    if (cat !== 'Sawmills') {
      setSawmillSub('All');
    }
  };

  const resetFilters = () => {
    onChangeCategory('All');
    setSawmillSub('All');
    setSelectedBrand('All');
    setSearchQuery('');
  };

  return (
    <div>
      <PageHeader
        title="Products Catalog"
        eyebrow="World-Leading Woodworking Machinery & Tooling"
        subtitle="Explore our complete authorized lineup from Altendorf, Leitz, and Wood-Mizer — backed by warranty, installation, and genuine spare parts."
        imageSrc={MEDIA_ASSETS.heroTooling}
        imageAlt="Precision circular saw blades and industrial milling tools"
        onNavigateHome={() => onNavigate('home')}
        currentLabel="Products"
      />

      <TrustBar />

      <section className="py-12 sm:py-16 bg-white">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 space-y-8">
          {/* Search & Brand Filter Row */}
          <div className="flex flex-col md:flex-row gap-4 items-stretch md:items-center justify-between bg-slate-50 border border-slate-200 rounded-xl p-4">
            <div className="relative flex-1 max-w-xl">
              <Search
                className="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2"
                aria-hidden="true"
              />
              <label htmlFor="products-inline-search" className="sr-only">
                Search products by name, brand, or specification
              </label>
              <input
                id="products-inline-search"
                type="text"
                value={searchQuery}
                onChange={(e) => setSearchQuery(e.target.value)}
                placeholder="Filter by model, brand, or specification (e.g. F 45, Leitz, Portable)..."
                className="w-full pl-10 pr-9 py-2.5 text-sm bg-white border border-slate-300 rounded-lg text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-[#1E2C7A]"
              />
              {searchQuery && (
                <button
                  type="button"
                  onClick={() => setSearchQuery('')}
                  aria-label="Clear product filter search"
                  className="absolute right-2.5 top-1/2 -translate-y-1/2 p-1 text-slate-400 hover:text-slate-700 cursor-pointer"
                >
                  <X className="w-4 h-4" aria-hidden="true" />
                </button>
              )}
            </div>

            <div className="flex items-center gap-1.5 bg-white border border-slate-200 p-1 rounded-lg overflow-x-auto">
              {BRANDS.map((brand) => {
                const active = selectedBrand === brand;
                return (
                  <button
                    key={brand}
                    type="button"
                    onClick={() => setSelectedBrand(brand)}
                    className={`px-3 py-1.5 text-xs font-semibold rounded-md transition-colors whitespace-nowrap shrink-0 cursor-pointer ${
                      active
                        ? 'bg-[#1E2C7A] text-white'
                        : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100'
                    }`}
                  >
                    {brand === 'All' ? 'All Brands' : brand}
                  </button>
                );
              })}
            </div>
          </div>

          {/* 9 Category Tabs */}
          <div className="space-y-3">
            <div
              role="tablist"
              aria-label="Product categories"
              className="flex flex-wrap gap-2"
            >
              <button
                type="button"
                role="tab"
                aria-selected={selectedCategory === 'All'}
                onClick={() => handleCategorySelect('All')}
                className={`px-4 py-2 text-xs sm:text-sm font-semibold rounded-lg border transition-colors whitespace-nowrap shrink-0 cursor-pointer ${
                  selectedCategory === 'All'
                    ? 'bg-[#1E2C7A] text-white border-[#1E2C7A]'
                    : 'bg-white text-slate-700 border-slate-200 hover:border-[#1E2C7A]'
                }`}
              >
                All Products
              </button>
              {PRODUCT_CATEGORIES.map((category) => {
                const isSelected = selectedCategory === category;
                return (
                  <button
                    key={category}
                    type="button"
                    role="tab"
                    aria-selected={isSelected}
                    onClick={() => handleCategorySelect(category)}
                    className={`px-4 py-2 text-xs sm:text-sm font-semibold rounded-lg border transition-colors whitespace-nowrap shrink-0 cursor-pointer ${
                      isSelected
                        ? 'bg-[#1E2C7A] text-white border-[#1E2C7A]'
                        : 'bg-white text-slate-700 border-slate-200 hover:border-[#1E2C7A]'
                    }`}
                  >
                    {category}
                  </button>
                );
              })}
            </div>

            {/* Sawmill Subcategories when Sawmills selected */}
            {selectedCategory === 'Sawmills' && (
              <div className="flex flex-wrap items-center gap-2 pt-1">
                <span className="text-xs font-semibold text-slate-500 mr-1">
                  Sawmill Type:
                </span>
                <button
                  type="button"
                  onClick={() => setSawmillSub('All')}
                  className={`px-3 py-1.5 text-xs font-semibold rounded-md transition-colors whitespace-nowrap shrink-0 cursor-pointer ${
                    sawmillSub === 'All'
                      ? 'bg-[#F2B705] text-[#131D54]'
                      : 'bg-slate-100 text-slate-700 hover:bg-slate-200'
                  }`}
                >
                  All Sawmills
                </button>
                {SAWMILL_SUBCATEGORIES.map((sub) => (
                  <button
                    key={sub}
                    type="button"
                    onClick={() => setSawmillSub(sub)}
                    className={`px-3 py-1.5 text-xs font-semibold rounded-md transition-colors whitespace-nowrap shrink-0 cursor-pointer ${
                      sawmillSub === sub
                        ? 'bg-[#F2B705] text-[#131D54]'
                        : 'bg-slate-100 text-slate-700 hover:bg-slate-200'
                    }`}
                  >
                    {sub}
                  </button>
                ))}
              </div>
            )}
          </div>

          {/* Count Header */}
          <div className="flex items-center justify-between border-b border-slate-200 pb-3 text-sm text-slate-600">
            <p className="tabular-nums">
              Showing <strong className="text-slate-900">{filteredProducts.length}</strong>{' '}
              {filteredProducts.length === 1 ? 'product' : 'products'}
              {selectedCategory !== 'All' ? ` in ${selectedCategory}` : ''}
            </p>
            {(selectedCategory !== 'All' ||
              selectedBrand !== 'All' ||
              searchQuery.trim()) && (
              <button
                type="button"
                onClick={resetFilters}
                className="text-xs font-semibold text-[#1E2C7A] hover:underline cursor-pointer"
              >
                Reset all filters
              </button>
            )}
          </div>

          {/* Product Grid */}
          {filteredProducts.length === 0 ? (
            <div className="py-16 text-center bg-slate-50 border border-slate-200 rounded-2xl px-4">
              <p className="text-lg font-bold text-slate-900 mb-2">
                No machinery matched your filters
              </p>
              <p className="text-sm text-slate-600 mb-5">
                Clear your search or switch categories to view all 38 machines
                and cutting tools.
              </p>
              <button
                type="button"
                onClick={resetFilters}
                className="px-5 py-2.5 text-sm font-semibold text-white bg-[#1E2C7A] hover:bg-[#131D54] rounded-lg transition-colors cursor-pointer"
              >
                Show All Products
              </button>
            </div>
          ) : (
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
              {filteredProducts.map((product) => (
                <ProductCard
                  key={product.id}
                  product={product}
                  onSelect={onSelectProduct}
                  onInquire={onInquireProduct}
                />
              ))}
            </div>
          )}
        </div>
      </section>

      <WhySerendibSection />
    </div>
  );
};
