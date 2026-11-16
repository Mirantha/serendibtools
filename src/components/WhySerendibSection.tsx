import React from 'react';
import {
  ShieldCheck,
  Truck,
  Wrench,
  RefreshCw,
  Headphones,
  CheckCircle2,
  HardHat,
  BadgeDollarSign,
} from 'lucide-react';
import { TRUST_GUARANTEES, WHY_CHOOSE_US } from '../data/siteData';

const GUARANTEE_ICONS = [
  ShieldCheck,
  Truck,
  Wrench,
  RefreshCw,
  Headphones,
];

const WHY_ICONS = [CheckCircle2, HardHat, Wrench, BadgeDollarSign];

export const TrustBar: React.FC = () => {
  return (
    <div className="bg-white border-b border-slate-200">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 py-4">
        <div className="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 sm:gap-4">
          {TRUST_GUARANTEES.map((item, idx) => {
            const Icon = GUARANTEE_ICONS[idx % GUARANTEE_ICONS.length];
            return (
              <div
                key={item}
                className="flex items-center gap-2.5 text-xs sm:text-sm font-semibold text-slate-800 py-1"
              >
                <span className="w-8 h-8 rounded-lg bg-[#1E2C7A]/8 text-[#1E2C7A] flex items-center justify-center shrink-0">
                  <Icon className="w-4 h-4" aria-hidden="true" />
                </span>
                <span className="leading-tight">{item}</span>
              </div>
            );
          })}
        </div>
      </div>
    </div>
  );
};

export const WhySerendibSection: React.FC = () => {
  return (
    <section className="py-16 bg-slate-50 border-t border-slate-200">
      <div className="max-w-7xl mx-auto px-4 sm:px-6">
        <div className="max-w-2xl mb-10">
          <p className="text-xs font-semibold uppercase tracking-wider text-[#1E2C7A] mb-2">
            Why Serendib
          </p>
          <h2 className="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight mb-3">
            Why Clients Choose Us
          </h2>
          <p className="text-sm sm:text-base text-slate-600 leading-relaxed">
            We are more than a machinery supplier — we are your long-term
            industry partner committed to your growth.
          </p>
        </div>

        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
          {WHY_CHOOSE_US.map((item, idx) => {
            const Icon = WHY_ICONS[idx % WHY_ICONS.length];
            return (
              <div
                key={item.id}
                className="bg-white border border-slate-200 rounded-xl p-6 hover:border-[#1E2C7A]/40 transition-colors"
              >
                <div className="w-10 h-10 rounded-lg bg-[#1E2C7A] text-[#F2B705] flex items-center justify-center mb-4">
                  <Icon className="w-5 h-5" aria-hidden="true" />
                </div>
                <h3 className="text-base font-bold text-slate-900 mb-2">
                  {item.title}
                </h3>
                <p className="text-sm text-slate-600 leading-relaxed">
                  {item.description}
                </p>
              </div>
            );
          })}
        </div>
      </div>
    </section>
  );
};
