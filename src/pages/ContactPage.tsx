import React, { useEffect, useState } from 'react';
import {
  MapPin,
  Phone,
  Mail,
  Clock,
  CheckCircle2,
  MessageCircle,
  Send,
} from 'lucide-react';
import { COMPANY_INFO, type PageRoute } from '../data/siteData';
import { MEDIA_ASSETS } from '../data/mediaAssets';
import {
  buildWhatsAppUrl,
  validateQuoteForm,
  type QuoteFormErrors,
} from '../utils/catalog';
import { PageHeader } from '../components/PageHeader';
import { LocationMap } from '../components/LocationMap';
import { TrustBar, WhySerendibSection } from '../components/WhySerendibSection';

interface ContactPageProps {
  prefillService?: string;
  prefillMessage?: string;
  onNavigate: (page: PageRoute) => void;
}

const SERVICE_OPTIONS = [
  'Wood & Log Sawing Machines',
  'Furniture & Industrial Tools',
  'Machinery Installation',
  'Interior & Factory Setup',
  'UPVC / Aluminium / Metal',
  'After-Sales Maintenance',
  'Other Enquiry',
];

export const ContactPage: React.FC<ContactPageProps> = ({
  prefillService = '',
  prefillMessage = '',
  onNavigate,
}) => {
  const [fullName, setFullName] = useState('');
  const [phone, setPhone] = useState('');
  const [email, setEmail] = useState('');
  const [serviceRequired, setServiceRequired] = useState(prefillService);
  const [message, setMessage] = useState(prefillMessage);
  const [errors, setErrors] = useState<QuoteFormErrors>({});
  const [submitted, setSubmitted] = useState(false);

  useEffect(() => {
    if (prefillService) setServiceRequired(prefillService);
    if (prefillMessage) setMessage(prefillMessage);
  }, [prefillService, prefillMessage]);

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    const validation = validateQuoteForm({
      fullName,
      phone,
      email,
      serviceRequired,
      message,
    });
    setErrors(validation);
    if (Object.keys(validation).length === 0) {
      setSubmitted(true);
    }
  };

  const whatsappFollowup = buildWhatsAppUrl(
    COMPANY_INFO.whatsappNumber,
    `Hello Serendib Tools, my name is ${fullName || 'a customer'}. Service needed: ${serviceRequired || 'General Enquiry'}. ${message}`
  );

  return (
    <div>
      <PageHeader
        title="Contact Us"
        eyebrow="Get In Touch"
        subtitle="Our team is ready to assist with product inquiries, pricing, installation, and after-sales support."
        imageSrc={MEDIA_ASSETS.bannerContactShowroom}
        imageAlt="Serendib Tools & Machineries showroom in Kesbawa, Sri Lanka"
        onNavigateHome={() => onNavigate('home')}
        currentLabel="Contact"
      />

      <TrustBar />

      {/* 4 Direct Contact Cards */}
      <section className="pt-14 pb-8 bg-white">
        <div className="max-w-7xl mx-auto px-4 sm:px-6">
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <div className="p-6 rounded-xl bg-slate-50 border border-slate-200">
              <div className="w-10 h-10 rounded-lg bg-[#1E2C7A] text-[#F2B705] flex items-center justify-center mb-3.5">
                <MapPin className="w-5 h-5" aria-hidden="true" />
              </div>
              <h2 className="text-sm font-bold text-slate-900 mb-1">
                Our Location
              </h2>
              <p className="text-sm text-slate-600 leading-relaxed">
                {COMPANY_INFO.address}
              </p>
            </div>

            <div className="p-6 rounded-xl bg-slate-50 border border-slate-200">
              <div className="w-10 h-10 rounded-lg bg-[#1E2C7A] text-[#F2B705] flex items-center justify-center mb-3.5">
                <Phone className="w-5 h-5" aria-hidden="true" />
              </div>
              <h2 className="text-sm font-bold text-slate-900 mb-1">
                Phone Number
              </h2>
              <a
                href={COMPANY_INFO.phoneHref}
                className="text-sm font-semibold text-[#1E2C7A] hover:underline tabular-nums"
              >
                {COMPANY_INFO.phoneDisplay}
              </a>
            </div>

            <div className="p-6 rounded-xl bg-slate-50 border border-slate-200">
              <div className="w-10 h-10 rounded-lg bg-[#1E2C7A] text-[#F2B705] flex items-center justify-center mb-3.5">
                <Mail className="w-5 h-5" aria-hidden="true" />
              </div>
              <h2 className="text-sm font-bold text-slate-900 mb-1">
                Email Address
              </h2>
              <a
                href={`mailto:${COMPANY_INFO.email}`}
                className="text-sm font-semibold text-[#1E2C7A] hover:underline"
              >
                {COMPANY_INFO.email}
              </a>
            </div>

            <div className="p-6 rounded-xl bg-slate-50 border border-slate-200">
              <div className="w-10 h-10 rounded-lg bg-[#1E2C7A] text-[#F2B705] flex items-center justify-center mb-3.5">
                <Clock className="w-5 h-5" aria-hidden="true" />
              </div>
              <h2 className="text-sm font-bold text-slate-900 mb-1">
                Working Hours
              </h2>
              <p className="text-sm text-slate-600 leading-relaxed">
                {COMPANY_INFO.hours}
              </p>
            </div>
          </div>
        </div>
      </section>

      {/* Location Map + Request a Free Quote Split */}
      <section className="py-10 pb-16 bg-white">
        <div className="max-w-7xl mx-auto px-4 sm:px-6">
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
            {/* Interactive Map Column */}
            <div className="lg:col-span-6">
              <LocationMap />
            </div>

            {/* Quote Request Form Column */}
            <div className="lg:col-span-6 bg-slate-50 border border-slate-200 rounded-2xl p-6 sm:p-8">
              <h2 className="text-2xl font-bold text-slate-900 mb-1.5">
                Request a Free Quote
              </h2>
              <p className="text-sm text-slate-600 mb-6">
                Fill in the form and our team will respond within 24 hours.
              </p>

              {submitted ? (
                <div
                  role="status"
                  className="bg-white border border-emerald-200 rounded-xl p-6 space-y-4"
                >
                  <div className="flex items-start gap-3">
                    <CheckCircle2
                      className="w-6 h-6 text-emerald-600 shrink-0 mt-0.5"
                      aria-hidden="true"
                    />
                    <div>
                      <h3 className="text-base font-bold text-slate-900">
                        Enquiry Recorded — Ready for Dispatch
                      </h3>
                      <p className="text-sm text-slate-600 mt-1">
                        Thank you, <strong>{fullName}</strong>. Our Kesbawa sales
                        engineering desk has logged your request for{' '}
                        <strong>{serviceRequired}</strong> and will reach out to{' '}
                        <span className="tabular-nums">{phone}</span> within 24
                        hours.
                      </p>
                    </div>
                  </div>
                  <div className="flex flex-wrap gap-3 pt-2">
                    <a
                      href={whatsappFollowup}
                      target="_blank"
                      rel="noopener noreferrer"
                      className="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-white bg-[#16A34A] hover:bg-[#15803D] rounded-lg transition-colors"
                    >
                      <MessageCircle className="w-4 h-4" aria-hidden="true" />
                      <span>Send Immediately via WhatsApp</span>
                    </a>
                    <button
                      type="button"
                      onClick={() => {
                        setSubmitted(false);
                        setFullName('');
                        setPhone('');
                        setEmail('');
                        setServiceRequired('');
                        setMessage('');
                      }}
                      className="px-4 py-2.5 text-sm font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors cursor-pointer"
                    >
                      Send Another Enquiry
                    </button>
                  </div>
                </div>
              ) : (
                <form onSubmit={handleSubmit} noValidate className="space-y-4">
                  <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                      <label
                        htmlFor="quote-full-name"
                        className="block text-xs font-semibold text-slate-700 mb-1.5"
                      >
                        Full Name *
                      </label>
                      <input
                        id="quote-full-name"
                        type="text"
                        value={fullName}
                        onChange={(e) => setFullName(e.target.value)}
                        placeholder="Your full name"
                        className={`w-full px-3.5 py-2.5 text-sm bg-white border rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#1E2C7A] ${
                          errors.fullName
                            ? 'border-red-500'
                            : 'border-slate-300'
                        }`}
                      />
                      {errors.fullName && (
                        <p className="text-xs text-red-600 mt-1">
                          {errors.fullName}
                        </p>
                      )}
                    </div>

                    <div>
                      <label
                        htmlFor="quote-phone"
                        className="block text-xs font-semibold text-slate-700 mb-1.5"
                      >
                        Phone *
                      </label>
                      <input
                        id="quote-phone"
                        type="tel"
                        value={phone}
                        onChange={(e) => setPhone(e.target.value)}
                        placeholder="+94 XX XXX XXXX"
                        className={`w-full px-3.5 py-2.5 text-sm bg-white border rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#1E2C7A] tabular-nums ${
                          errors.phone ? 'border-red-500' : 'border-slate-300'
                        }`}
                      />
                      {errors.phone && (
                        <p className="text-xs text-red-600 mt-1">
                          {errors.phone}
                        </p>
                      )}
                    </div>
                  </div>

                  <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                      <label
                        htmlFor="quote-email"
                        className="block text-xs font-semibold text-slate-700 mb-1.5"
                      >
                        Email
                      </label>
                      <input
                        id="quote-email"
                        type="email"
                        value={email}
                        onChange={(e) => setEmail(e.target.value)}
                        placeholder="your@email.com"
                        className={`w-full px-3.5 py-2.5 text-sm bg-white border rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#1E2C7A] ${
                          errors.email ? 'border-red-500' : 'border-slate-300'
                        }`}
                      />
                      {errors.email && (
                        <p className="text-xs text-red-600 mt-1">
                          {errors.email}
                        </p>
                      )}
                    </div>

                    <div>
                      <label
                        htmlFor="quote-service"
                        className="block text-xs font-semibold text-slate-700 mb-1.5"
                      >
                        Service Required *
                      </label>
                      <select
                        id="quote-service"
                        value={serviceRequired}
                        onChange={(e) => setServiceRequired(e.target.value)}
                        className={`w-full px-3.5 py-2.5 text-sm bg-white border rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#1E2C7A] ${
                          errors.serviceRequired
                            ? 'border-red-500'
                            : 'border-slate-300'
                        }`}
                      >
                        <option value="">Select a category…</option>
                        {SERVICE_OPTIONS.map((opt) => (
                          <option key={opt} value={opt}>
                            {opt}
                          </option>
                        ))}
                      </select>
                      {errors.serviceRequired && (
                        <p className="text-xs text-red-600 mt-1">
                          {errors.serviceRequired}
                        </p>
                      )}
                    </div>
                  </div>

                  <div>
                    <label
                      htmlFor="quote-message"
                      className="block text-xs font-semibold text-slate-700 mb-1.5"
                    >
                      Message
                    </label>
                    <textarea
                      id="quote-message"
                      rows={4}
                      value={message}
                      onChange={(e) => setMessage(e.target.value)}
                      placeholder="Describe your requirements..."
                      className="w-full px-3.5 py-2.5 text-sm bg-white border border-slate-300 rounded-lg text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#1E2C7A]"
                    />
                  </div>

                  <button
                    type="submit"
                    className="w-full inline-flex items-center justify-center gap-2 py-3 px-6 text-sm font-bold text-[#131D54] bg-[#F2B705] hover:bg-[#D69E00] rounded-lg transition-colors cursor-pointer"
                  >
                    <Send className="w-4 h-4" aria-hidden="true" />
                    <span>Send Enquiry Now</span>
                  </button>
                </form>
              )}
            </div>
          </div>
        </div>
      </section>

      <WhySerendibSection />
    </div>
  );
};
