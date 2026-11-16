import React, { useState } from 'react';
import { ChevronLeft, ChevronRight, ArrowRight } from 'lucide-react';
import { PRODUCTS, type ProductItem } from '../data/siteData';
import { ProductCard } from './ProductCard';

interface FeaturedSliderProps {
  onSelectProduct: (product: ProductItem) => void;
  onInquireProduct: (product: ProductItem) => void;
  onViewAllProducts: () => void;
}

export const FeaturedSlider: React.FC<FeaturedSliderProps> = ({
  onSelectProduct,
  onInquireProduct,
  onViewAllProducts,
}) => {
  const featured = PRODUCTS.filter((p) => p.featured);
  const [startIndex, setStartIndex] = useState(0);
  const visibleCount = 3;
  const maxStart = Math.max(0, featured.length - visibleCount);

  const handlePrev = () => {
    setStartIndex((prev) => (prev <= 0 ? maxStart : prev - 1));
  };

  const handleNext = () => {
    setStartIndex((prev) => (prev >= maxStart ? 0 : prev + 1));
  };

  const visibleProducts = featured.slice(startIndex, startIndex + visibleCount);

  return (
    <section className="py-16 bg-slate-50 border-y border-slate-200">
      <div className="max-w-7xl mx-auto px-4 sm:px-6">
        <div className="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-10">
          <div>
            <p className="text-xs font-semibold uppercase tracking-wider text-[#1E2C7A] mb-2">
              Flagship Equipment Lineup
            </p>
            <h2 className="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight">
              Featured Machinery &amp; Precision Tooling
            </h2>
          </div>

          <div className="flex items-center gap-2.5">
            <button
              type="button"
              onClick={handlePrev}
              aria-label="Previous featured products"
              className="w-10 h-10 rounded-lg border border-slate-300 bg-white hover:border-[#1E2C7A] hover:text-[#1E2C7A] text-slate-700 flex items-center justify-center transition-colors cursor-pointer"
            >
              <ChevronLeft className="w-5 h-5" aria-hidden="true" />
            </button>
            <button
              type="button"
              onClick={handleNext}
              aria-label="Next featured products"
              className="w-10 h-10 rounded-lg border border-slate-300 bg-white hover:border-[#1E2C7A] hover:text-[#1E2C7A] text-slate-700 flex items-center justify-center transition-colors cursor-pointer"
            >
              <ChevronRight className="w-5 h-5" aria-hidden="true" />
            </button>
            <button
              type="button"
              onClick={onViewAllProducts}
              className="ml-2 inline-flex items-center gap-1.5 px-4 py-2.5 text-sm font-semibold text-white bg-[#1E2C7A] hover:bg-[#131D54] rounded-lg transition-colors cursor-pointer whitespace-nowrap"
            >
              <span>All 38 Products</span>
              <ArrowRight className="w-4 h-4" aria-hidden="true" />
            </button>
          </div>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
          {visibleProducts.map((product) => (
            <ProductCard
              key={product.id}
              product={product}
              onSelect={onSelectProduct}
              onInquire={onInquireProduct}
            />
          ))}
        </div>

        {/* Slider progress indicator */}
        <div className="mt-6 flex items-center justify-center gap-2">
          {Array.from({ length: maxStart + 1 }).map((_, idx) => (
            <button
              key={idx}
              type="button"
              aria-label={`Show featured slide ${idx + 1}`}
              onClick={() => setStartIndex(idx)}
              className={`h-1.5 rounded-full transition-all cursor-pointer ${
                idx === startIndex ? 'w-8 bg-[#1E2C7A]' : 'w-2.5 bg-slate-300'
              }`}
            />
          ))}
        </div>
      </div>
    </section>
  );
};
