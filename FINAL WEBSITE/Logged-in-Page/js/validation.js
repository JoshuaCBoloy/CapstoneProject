const validation = new JustValidate("#signup");

validation.addField("#name", [
  {
    rule: "required",
  },
]);
