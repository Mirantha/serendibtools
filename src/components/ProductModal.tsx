import React from 'react';
import { X, CheckCircle2, MessageCircle, FileText } from 'lucide-react';
import { COMPANY_INFO, type ProductItem } from '../data/siteData';
import { buildWhatsAppUrl } from '../utils/catalog';

interface ProductModalProps {
  product: ProductItem | null;
  onClose: () => void;
  onRequestQuote: (product: ProductItem) => void;
}

export const ProductModal: React.FC<ProductModalProps> = ({
  product,
  onClose,
  onRequestQuote,
}) => {
  if (!product) return null;

  const whatsappLink = buildWhatsAppUrl(
    COMPANY_INFO.whatsappNumber,
    `Hello Serendib Tools, I would like pricing and technical specifications for: ${product.name} (${product.brand}).`
  );

  return (
    <div
      role="dialog"
      aria-modal="true"
      aria-label={product.name}
      className="fixed inset-0 z-50 bg-slate-950/65 backdrop-blur-xs flex items-center justify-center p-4"
      onClick={onClose}
    >
      <div
        className="w-full max-w-3xl bg-white rounded-2xl shadow-2xl border border-slate-200 overflow-hidden grid grid-cols-1 md:grid-cols-2"
        onClick={(e) => e.stopPropagation()}
      >
        {/* Left Image Showcase */}
        <div className="bg-slate-50 border-b md:border-b-0 md:border-r border-slate-200 p-6 flex items-center justify-center min-h-[260px]">
          <img
            src={product.image}
            alt={product.name}
            referrerPolicy="no-referrer"
            className="w-full max-h-72 object-contain"
          />
        </div>

        {/* Right Specification & Inquiry */}
        <div className="p-6 flex flex-col justify-between">
          <div>
            <div className="flex items-start justify-between gap-4 mb-3">
              <div className="text-xs font-semibold text-[#1E2C7A]">
                {product.brand} · {product.subcategory ?? product.category}
              </div>
              <button
                type="button"
                onClick={onClose}
                aria-label="Close product details"
                className="p-1.5 text-slate-400 hover:text-slate-800 hover:bg-slate-100 rounded-lg transition-colors cursor-pointer"
              >
                <X className="w-5 h-5" aria-hidden="true" />
              </button>
            </div>

            <h2 className="text-xl sm:text-2xl font-bold text-slate-900 leading-snug mb-2">
              {product.name}
            </h2>

            {product.tagline && (
              <p className="text-sm font-semibold text-[#1E2C7A] mb-2">
                {product.tagline}
              </p>
            )}

            <p className="text-sm text-slate-600 leading-relaxed mb-5">
              {product.description}
            </p>

            <div className="space-y-2 mb-6">
              <p className="text-xs font-semibold uppercase tracking-wider text-slate-500">
                Key Highlights
              </p>
              <ul className="space-y-1.5">
                {product.highlights.map((hl) => (
                  <li
                    key={hl}
                    className="flex items-center gap-2 text-sm text-slate-700"
                  >
                    <CheckCircle2
                      className="w-4 h-4 text-[#1E2C7A] shrink-0"
                      aria-hidden="true"
                    />
                    <span>{hl}</span>
                  </li>
                ))}
                <li className="flex items-center gap-2 text-sm text-slate-700">
                  <CheckCircle2
                    className="w-4 h-4 text-[#1E2C7A] shrink-0"
                    aria-hidden="true"
                  />
                  <span>Includes Warranty &amp; Island-Wide Installation Support</span>
                </li>
              </ul>
            </div>
          </div>

          <div className="pt-4 border-t border-slate-100 flex flex-col sm:flex-row gap-2.5">
            <button
              type="button"
              onClick={() => {
                onClose();
                onRequestQuote(product);
              }}
              className="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold text-[#131D54] bg-[#F2B705] hover:bg-[#D69E00] rounded-lg transition-colors cursor-pointer"
            >
              <FileText className="w-4 h-4" aria-hidden="true" />
              <span>Request Quote</span>
            </button>
            <a
              href={whatsappLink}
              target="_blank"
              rel="noopener noreferrer"
              className="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold text-white bg-[#16A34A] hover:bg-[#15803D] rounded-lg transition-colors"
            >
              <MessageCircle className="w-4 h-4" aria-hidden="true" />
              <span>WhatsApp Inquiry</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  );
};
