import React, { useState } from 'react';
import { MessageCircle, X, Send } from 'lucide-react';
import { COMPANY_INFO } from '../data/siteData';
import { buildWhatsAppUrl } from '../utils/catalog';

const QUICK_TOPICS = [
  'Machinery Quote (Altendorf / Wood-Mizer)',
  'Leitz Saw Blades & Cutters',
  'Installation & Technical Support',
  'Book a Kesbawa Showroom Visit',
];

export const WhatsAppWidget: React.FC = () => {
  const [open, setOpen] = useState(false);
  const [message, setMessage] = useState(
    'Hello Serendib Tools, I would like information on your woodworking machinery and pricing.'
  );

  const launchHref = buildWhatsAppUrl(COMPANY_INFO.whatsappNumber, message);

  return (
    <div className="fixed bottom-5 right-5 z-40 flex flex-col items-end gap-3">
      {open && (
        <div
          role="dialog"
          aria-label="WhatsApp Live Support Chat"
          className="w-80 sm:w-96 bg-white rounded-2xl shadow-2xl border border-slate-200 overflow-hidden"
        >
          {/* Header */}
          <div className="bg-[#1E2C7A] text-white px-4 py-3.5 flex items-center justify-between border-b-2 border-[#F2B705]">
            <div>
              <p className="text-sm font-bold leading-tight">
                Serendib Tools Support
              </p>
              <p className="text-xs text-slate-200 mt-0.5 tabular-nums">
                WhatsApp · {COMPANY_INFO.phoneCompact}
              </p>
            </div>
            <button
              type="button"
              onClick={() => setOpen(false)}
              aria-label="Minimize WhatsApp chat"
              className="p-1.5 rounded-lg text-slate-200 hover:text-white hover:bg-white/10 transition-colors cursor-pointer"
            >
              <X className="w-4 h-4" aria-hidden="true" />
            </button>
          </div>

          {/* Quick Topics + Message Box */}
          <div className="p-4 space-y-3 bg-slate-50">
            <div className="bg-white border border-slate-200 rounded-xl p-3 text-xs text-slate-700 leading-relaxed">
              Hello! How can our machinery specialists in Kesbawa assist you today?
            </div>

            <div>
              <p className="text-xs font-semibold text-slate-500 mb-1.5">
                Quick Topics
              </p>
              <div className="flex flex-wrap gap-1.5">
                {QUICK_TOPICS.map((topic) => (
                  <button
                    key={topic}
                    type="button"
                    onClick={() =>
                      setMessage(
                        `Hello Serendib Tools, I am enquiring about: ${topic}.`
                      )
                    }
                    className="px-2.5 py-1 text-xs font-medium text-[#1E2C7A] bg-white border border-slate-200 hover:border-[#1E2C7A] rounded-md transition-colors cursor-pointer text-left"
                  >
                    {topic}
                  </button>
                ))}
              </div>
            </div>

            <div>
              <label
                htmlFor="whatsapp-chat-input"
                className="block text-xs font-semibold text-slate-600 mb-1"
              >
                Your Message
              </label>
              <textarea
                id="whatsapp-chat-input"
                rows={3}
                value={message}
                onChange={(e) => setMessage(e.target.value)}
                className="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#1E2C7A]"
              />
            </div>

            <a
              href={launchHref}
              target="_blank"
              rel="noopener noreferrer"
              className="w-full inline-flex items-center justify-center gap-2 py-2.5 px-4 rounded-lg bg-[#16A34A] hover:bg-[#15803D] text-white text-sm font-semibold transition-colors"
            >
              <Send className="w-4 h-4" aria-hidden="true" />
              <span>Start WhatsApp Chat</span>
            </a>
          </div>
        </div>
      )}

      {/* Floating Toggle Button */}
      <button
        type="button"
        onClick={() => setOpen((prev) => !prev)}
        aria-expanded={open}
        aria-label={open ? 'Close WhatsApp chat' : 'Open WhatsApp chat'}
        className="inline-flex items-center gap-2.5 px-4 py-3 rounded-full bg-[#16A34A] hover:bg-[#15803D] text-white shadow-lg hover:shadow-xl transition-all cursor-pointer focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#1E2C7A]"
      >
        <MessageCircle className="w-5 h-5" aria-hidden="true" />
        <span className="text-sm font-semibold whitespace-nowrap">
          WhatsApp Chat
        </span>
      </button>
    </div>
  );
};
