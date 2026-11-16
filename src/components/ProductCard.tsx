import React, { useState } from 'react';
import { ArrowUpRight, Wrench } from 'lucide-react';
import type { ProductItem } from '../data/siteData';

interface ProductCardProps {
  product: ProductItem;
  onSelect: (product: ProductItem) => void;
  onInquire: (product: ProductItem) => void;
}

export const ProductCard: React.FC<ProductCardProps> = ({
  product,
  onSelect,
  onInquire,
}) => {
  const [imgError, setImgError] = useState(false);

  return (
    <article className="group flex flex-col bg-white border border-slate-200 rounded-xl overflow-hidden hover:border-[#1E2C7A]/40 hover:shadow-md transition-all duration-200">
      {/* Image Frame (4:3 neutral showcase backdrop) */}
      <button
        type="button"
        onClick={() => onSelect(product)}
        aria-label={`View details for ${product.name}`}
        className="relative aspect-[4/3] w-full bg-slate-50 border-b border-slate-100 overflow-hidden cursor-pointer flex items-center justify-center p-4"
      >
        {!imgError ? (
          <img
            src={product.image}
            alt={product.name}
            loading="lazy"
            referrerPolicy="no-referrer"
            onError={() => setImgError(true)}
            className="w-full h-full object-contain group-hover:scale-[1.03] transition-transform duration-300"
          />
        ) : (
          <div className="flex flex-col items-center justify-center text-slate-400 gap-2 p-4">
            <Wrench className="w-8 h-8 text-[#1E2C7A]/40" aria-hidden="true" />
            <span className="text-xs font-medium text-slate-500 text-center">
              {product.name}
            </span>
          </div>
        )}
      </button>

      {/* Card Body */}
      <div className="flex-1 flex flex-col p-5">
        <div className="flex items-center gap-2 text-xs font-medium text-slate-500 mb-1.5">
          <span className="text-[#1E2C7A] font-semibold">{product.brand}</span>
          <span aria-hidden="true">·</span>
          <span className="truncate">
            {product.subcategory ? product.subcategory : product.category}
          </span>
        </div>

        <h3 className="text-base font-bold text-slate-900 leading-snug mb-2">
          <button
            type="button"
            onClick={() => onSelect(product)}
            className="text-left hover:text-[#1E2C7A] transition-colors cursor-pointer"
          >
            {product.name}
          </button>
        </h3>

        <p className="text-sm text-slate-600 leading-relaxed line-clamp-3 mb-4 flex-1">
          {product.description}
        </p>

        {/* Actions */}
        <div className="pt-3 border-t border-slate-100 flex items-center justify-between gap-3">
          <button
            type="button"
            onClick={() => onSelect(product)}
            className="text-xs font-semibold text-[#1E2C7A] hover:text-[#131D54] inline-flex items-center gap-1 cursor-pointer whitespace-nowrap"
          >
            <span>Specifications</span>
            <ArrowUpRight className="w-3.5 h-3.5" aria-hidden="true" />
          </button>
          <button
            type="button"
            onClick={() => onInquire(product)}
            className="px-3.5 py-1.5 text-xs font-semibold text-[#131D54] bg-[#F2B705] hover:bg-[#D69E00] rounded-lg transition-colors cursor-pointer whitespace-nowrap shrink-0"
          >
            Request Quote
          </button>
        </div>
      </div>
    </article>
  );
};
