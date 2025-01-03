import React, { useState, useEffect } from 'react';

const HeroSlider = () => {
  const [currentSlide, setCurrentSlide] = useState(0);

  const slides = [
    {
      title: "Êtes-vous Etudiant(e) en Médecine?",
      subtitle: "profitez de nos QCM Par Cours",
      description: "MonQcm est un site qui vous propose une banque de questions pour les étudiants en médecine (FMPC). Les questions sont organisées par Examen et par chapitre avec la posibilité de consulter le Cours de chaque chapitre.",
      buttonText: "Se Connecter / S'inscrire",
      buttonLink: "#",
      image: "/api/placeholder/500/400"
    },
    {
      title: "Devenez membre OpenSkillRoom",
      subtitle: "et profitez des dernières expériences d'apprentissage",
      description: "OpenSkillRoom est une plateforme d'apprentissage au Maroc spécialisée dans les cours synchrones. Elle permet aux étudiants de participer en temps réel à des sessions interactives avec des instructeurs qualifiés. La plateforme favorise un environnement d'apprentissage collaboratif et flexible, adapté aux besoins du marché marocain.",
      buttonText: "Rejoignez-nous",
      buttonLink: "#s",
      image: "/api/placeholder/500/400"
    }
  ];

  useEffect(() => {
    const timer = setInterval(() => {
      setCurrentSlide((prev) => (prev + 1) % slides.length);
    }, 5000);
    return () => clearInterval(timer);
  }, []);

  return (
    <div className="relative w-full h-screen bg-gray-100">
      {slides.map((slide, index) => (
        <div
          key={index}
          className={`absolute inset-0 transition-opacity duration-500 ${
            currentSlide === index ? 'opacity-100' : 'opacity-0'
          }`}
        >
          <div className="max-w-7xl mx-auto h-full px-4 py-12 flex items-center">
            <div className="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
              <div className="space-y-6">
                <h1 className="text-4xl lg:text-6xl font-bold text-gray-800">
                  {slide.title}
                  <br />
                  <span className="text-3xl lg:text-4xl">{slide.subtitle}</span>
                </h1>
                <p className="text-lg text-gray-600 leading-relaxed">
                  {slide.description}
                </p>
                <div className="flex flex-wrap gap-4">
                  <a
                    href={slide.buttonLink}
                    className="inline-flex items-center px-6 py-3 bg-teal-500 text-white rounded-md hover:bg-teal-600 transition-colors"
                  >
                    {slide.buttonText}
                    <svg
                      className="ml-2 w-5 h-5"
                      fill="none"
                      stroke="currentColor"
                      viewBox="0 0 24 24"
                    >
                      <path
                        strokeLinecap="round"
                        strokeLinejoin="round"
                        strokeWidth={2}
                        d="M9 5l7 7-7 7"
                      />
                    </svg>
                  </a>
                  {index === 1 && (
                    <a
                      href="#"
                      className="inline-flex items-center px-6 py-3 text-gray-700 hover:text-gray-900 transition-colors"
                    >
                      Regarder l'aperçu
                      <svg
                        className="ml-2 w-5 h-5"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                      >
                        <path d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" />
                      </svg>
                    </a>
                  )}
                </div>
              </div>
              <div className="hidden lg:block">
                <img
                  src={slide.image}
                  alt="Hero image"
                  className="w-full h-auto rounded-lg shadow-xl"
                />
              </div>
            </div>
          </div>
        </div>
      ))}
      
      <div className="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex space-x-3">
        {slides.map((_, index) => (
          <button
            key={index}
            onClick={() => setCurrentSlide(index)}
            className={`w-3 h-3 rounded-full transition-colors ${
              currentSlide === index ? 'bg-teal-500' : 'bg-gray-400'
            }`}
            aria-label={`Go to slide ${index + 1}`}
          />
        ))}
      </div>
    </div>
  );
};

export default HeroSlider;