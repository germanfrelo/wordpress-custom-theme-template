/** @type {import('stylelint').Config} */
export default {
	extends: [
		// Order matters: later configs take precedence over (override) earlier ones
		"stylelint-config-standard",
		"stylelint-config-recess-order",
	],
	reportDescriptionlessDisables: true,
	reportInvalidScopeDisables: true,
	reportNeedlessDisables: true,
	rules: {
		// Avoid errors: Unknown
		"declaration-property-value-no-unknown": true,
		"media-feature-name-value-no-unknown": true,
		"no-unknown-animations": true,
		"no-unknown-custom-media": true,
		"no-descending-specificity": [
			true,
			{
				severity: "warning",
			},
		],

		// Enforce conventions: Allowed, disallowed & required
		"color-named": [
			"never",
			{
				ignore: ["inside-function"],
			},
		],

		// Notation
		"media-feature-range-notation": null,

		// Enforce conventions: Patterns
		"custom-media-pattern": null,
		"custom-property-pattern": null,
		"keyframes-name-pattern": null,
		"selector-class-pattern": null,
		"selector-id-pattern": null,
	},
};
